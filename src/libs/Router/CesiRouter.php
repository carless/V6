<?php
namespace Cesi\Core\libs\Router;

use Illuminate\Support\Facades\Route;

class CesiRouter
{
    protected $extraRoutes = [];

    protected $name         = null;
    protected $controller   = null;
    protected $options      = null;

    public function __construct($name, $controller, $options)
    {
        $this->name = $name;
        $this->controller = $controller;
        $this->options = $options;

/*
Route::resource('users', 'UsersController');

Verb    Path                        Action  Route Name
GET     /users                      index   users.index
GET     /users/create               create  users.create
POST    /users                      store   users.store
GET     /users/{user}               show    users.show
GET     /users/{user}/edit          edit    users.edit
PUT     /users/{user}               update  users.update
DELETE  /users/{user}               destroy users.destroy
*/

        // CRUD routes for core features
        Route::get($this->name . '/',
            [
                'as' => $this->name . '.list',
                'uses' => $this->controller . '@index'
            ]);

        Route::post($this->name . '/getdata',
            [
                'as' => $this->name . '.getdata',
                'uses' => $this->controller . '@getdata'
            ]);

        Route::get($this->name . '/getdataajax',
            [
                'as' => $this->name . '.getdataajax',
                'uses' => $this->controller . '@getdataajax'
            ]);

        Route::get($this->name . '/create',
            [
                'as' => $this->name . '.create',
                'uses' => $this->controller . '@create'
            ]);

        Route::get($this->name . '/createmodal',
            [
                'as' => $this->name . '.createmodal',
                'uses' => $this->controller . '@createmodal'
            ]);

        Route::post($this->name . '/create',
            [
                'as' => $this->name . '.store',
                'uses' => $this->controller . '@store'
            ]);
/*
        Route::get($this->name . '/show/{id}',
            [
                'as' => $this->name . '.show',
                'uses' => $this->controller . '@show'
            ]);
*/
        Route::get($this->name . '/edit/{id}',
            [
                'as' => $this->name . '.edit',
                'uses' => $this->controller . '@edit'
            ]);


        Route::get($this->name . '/editmodal/{id}',
            [
                'as' => $this->name . '.editmodal',
                'uses' => $this->controller . '@editmodal'
            ]);

        // Con el methodo put no se pueden subir archivos ---> Ya esta arreglado
        Route::put($this->name . '/edit/{id}',
            [
                'as' => $this->name . '.update',
                'uses' => $this->controller . '@update'
            ]);

        Route::delete($this->name . '/delete/{id}',
            [
                'as' => $this->name . '.delete',
                'uses' => $this->controller . '@destroy'
            ]);
    }
}
