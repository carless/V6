<?php
namespace Cesi\Core\libs\Controllers\Traits;

use Illuminate\Http\Request;

trait OperationCreate
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setOperation('create');
        if ($this->tienePermiso('create')) {

            $class = $this->getModel();
            $entry = new $class();

            // get the info for that entry
            $this->data['title'] = $this->getTitle() ?? trans('cesi::core.crud.new') . ' ' . $this->entity_name;
            $this->data['heading']      = $this->getHeading() ?? $this->entity_name_plural;
            $this->data['subheading']   = $this->getSubheading() ?? trans('cesi::core.crud.new').' '.$this->entity_name;
            $this->data['entry']        = $entry;
            $this->data['contentClass'] = $this->getCreateContentClass();
            $this->data['routerAlias']      = $this->getRouterAlias();
            $this->data['resourceAlias']    = $this->getResourceAlias();
            $this->data['hasUploadFields']  = $this->hasUploadFields('create', $entry->getKey());

            $this->data['id'] = 0;

            // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
            return view($this->getCreateView(), $this->filterCreateViewData($this->data));
        } else {
            return view('cesi::errors.401');
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if ($this->tienePermiso('create')) {

            $valuesToSave = $this->getValuesToSave($request);
            $request->merge($valuesToSave);
            $validator = $this->checkValidate($request, 'store');

            if ($item = $this->getModel()->create($this->alterValuesToSave($request, $valuesToSave))) {
                return $this->getRedirectAfterSave($item, $request, 'store');
            }

            $isModalForm = $request->input('_ismodal' , '0');
            if ($isModalForm == 1) {
                echo "es un modal form --- error on save ---";
                die();
            }

            return redirect(route($this->getRouterAlias().'.list'));
        } else {
            return view('cesi::errors.401');
        }
        /*
        } else {
            throw new AccessDeniedException(trans('cesi::core.crud.unauthorized_access', ['access' => 'create']));
        }
        */
    }

    /**
     * Cargar valores para cuando estamos editando
     *
     * @param array $data
     * @return array
     */
    public function filterCreateViewData($data = [])
    {
        return $data;
    }

    /**
     * @param $record
     */
    public function AfterStore($record)
    {
    }
}