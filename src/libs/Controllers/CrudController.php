<?php
namespace Cesi\Core\libs\Controllers;

use Cesi\Core\libs\Controllers\Traits\Acceso;
use Cesi\Core\libs\Controllers\Traits\Buttons;
use Cesi\Core\libs\Controllers\Traits\Columns;
use Cesi\Core\libs\Controllers\Traits\HeadingsAndTitle;
use Cesi\Core\libs\Controllers\Traits\Listado;
use Cesi\Core\libs\Controllers\Traits\Operation;
use Cesi\Core\libs\Controllers\Traits\OperationList;
use Cesi\Core\libs\Controllers\Traits\OperationCreate;
use Cesi\Core\libs\Controllers\Traits\OperationUpdate;
use Cesi\Core\libs\Controllers\Traits\OperationDelete;
use Cesi\Core\libs\Controllers\Traits\Query;
use Cesi\Core\libs\Controllers\Traits\Read;
use Cesi\Core\libs\Controllers\Traits\Save;
use Cesi\Core\libs\Controllers\Traits\Views;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class CrudController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use Acceso, Operation, HeadingsAndTitle, Views, Buttons, Columns, Read, Query, Listado, Save;
    use OperationList, OperationCreate, OperationUpdate, OperationDelete;

    private $usuario = null;

    public $model;      // what's the namespace for your entity's model ex: "\App\Models\Entity";
    public $route;
    public $routerAlias = null;
    public $resourceAlias;
    public $entry;
    public $entity_name = 'entry'; // what name will show up on the buttons, in singural (ex: Add entity)
    public $entity_name_plural = 'entries'; // what name will show up on the buttons, in plural (ex: Delete 5 entities)
    public $request;    // is a \Illuminate\Http\Request

    public $data = array();

    /**
     * CrudController constructor.
     */
    public function __construct()
    {
        // call the setup function inside this closure to also have the request there
        // this way, developers can use things stored in session (auth variables, etc)
        $this->middleware(function ($request, $next) {
            $this->request = $request;
            $this->setup();

            return $next($request);
        });
    }

    /**
     * This function binds the CRUD to its corresponding Model (which extends Eloquent).
     * All Create-Read-Update-Delete operations are done using that Eloquent Collection.
     *
     * @param string $model_namespace Full model namespace. Ex: App\Models\Article
     *
     * @throws \Exception in case the model does not exist
     */
    public function setModel($model_namespace)
    {
        if (! class_exists($model_namespace)) {
            throw new \Exception('The model does not exist.', 500);
        }

        if (! method_exists($model_namespace, 'hasCesiCrudTrait')) {
            throw new \Exception('Please use CrudTrait on the model.', 500);
        }

        $this->model = new $model_namespace();
    }

    /**
     * Get the corresponding Eloquent Model for the CrudController, as defined with the setModel() function.
     *
     * @return string|\Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get the database connection, as specified in the .env file or overwritten by the property on the model.
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    private function getSchema()
    {
        return Schema::setConnection($this->getModel()->getConnection());
    }

    /**
     * Check if the database connection driver is using mongodb.
     *
     * @return bool
     */
    private function driverIsMongoDb()
    {
        return $this->getSchema()->getConnection()->getConfig()['driver'] === 'mongodb';
    }

    /**
     * @return \Illuminate\Http\Request
     */
    public function getRequest()
    {
        return $this->request;
    }


    // -----------------------------------------------
    // Route
    // -----------------------------------------------

    /**
     * @return null
     */
    public function getRouterAlias()
    {
        return $this->routerAlias;
    }

    /**
     * @param null $routerAlias
     */
    public function setRouterAlias($routerAlias)
    {
        $this->routerAlias = $routerAlias;
    }

    /**
     * Set the route for this CRUD.
     * Ex: admin/article.
     *
     * @param string $route Route name.
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * Get the current CrudController route.
     *
     * Can be defined in the CrudController with:
     * - $this->setRoute(config('cesi.core.route_prefix').'/article')
     * - $this->setRouteName(config('cesi.core.route_prefix').'.article')
     * - $this->route = config('cesi.core.route_prefix')."/article"
     *
     * @return string
     */
    public function getRoute()
    {
       return $this->route;
    }

    /**
     * Set the route for this CRUD using the route name.
     * Ex: admin.article.
     *
     * @param string $route      Route name.
     * @param array  $parameters Parameters.
     *
     * @throws \Exception
     */
    public function setRouteName($route, $parameters = [])
    {
        $complete_route = $route.'.index';

        if (! Route::has($complete_route)) {
            throw new \Exception('There are no routes for this route name.', 404);
        }

        $this->route = route($complete_route, $parameters);
        $this->initButtons();
    }

    /**
     * Set the entity name in singular and plural.
     * Used all over the CRUD interface (header, add button, reorder button, breadcrumbs).
     *
     * @param string $singular Entity name, in singular. Ex: article
     * @param string $plural   Entity name, in plural. Ex: articles
     */
    public function setEntityNameStrings($singular, $plural)
    {
        $this->entity_name = $singular;
        $this->entity_name_plural = $plural;
    }

    // -----------------------------------------------
    // ACTIONS - the current operation being processed
    // -----------------------------------------------

    /**
     * Get the action being performed by the controller,
     * including middleware names, route name, method name,
     * namespace, prefix, etc.
     *
     * @return string The EntityCrudController route action array.
     */
    public function getAction()
    {
        return $this->getRequest()->route()->getAction();
    }

    /**
     * Get the full name of the controller method
     * currently being called (including namespace).
     *
     * @return string The EntityCrudController full method name with namespace.
     */
    public function getActionName()
    {
        return $this->getRequest()->route()->getActionName();
    }

    /**
     * Get the name of the controller method
     * currently being called.
     *
     * @return string The EntityCrudController method name.
     */
    public function getActionMethod()
    {
        return $this->getRequest()->route()->getActionMethod();
    }

    /**
     * Check if the controller method being called
     * matches a given string.
     *
     * @param  string $methodName Name of the method (ex: index, create, update)
     *
     * @return bool                 Whether the condition is met or not.
     */
    public function actionIs($methodName)
    {
        return $methodName === $this->getActionMethod();
    }

    // -----------------------------------------------
    // ResourceAlias
    // -----------------------------------------------

    /**
     * Path de la view
     *
     * @param String $ViewName
     */
    public function setResourceAlias($ViewName)
    {
        $this->resourceAlias = $ViewName;
    }

    /**
     * Path de la view
     *
     * @return string
     */
    public function getResourceAlias()
    {
        if (property_exists($this, 'resourceAlias') && ! empty($this->resourceAlias)) {
            return $this->resourceAlias;
        } else {
            return "";
        }
    }

    // -----------------------------------------------
    // Gerenal Functions
    // -----------------------------------------------

    /**
     * Allow developers to set their configuration options for a CrudPanel.
     */
    public function setup()
    {
        $this->usuario = Auth::user();

        $this->initColumns();
        $this->initButtons();
    }
}