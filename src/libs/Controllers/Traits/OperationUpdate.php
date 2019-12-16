<?php
namespace Cesi\Core\libs\Controllers\Traits;

use Cesi\Core\app\Http\Controllers\Exceptions\AccessDeniedException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

trait OperationUpdate
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws AccessDeniedException
     */
    public function edit($id)
    {
        $this->setOperation('update');
        if ($this->tienePermiso('update')) {

            // get entry ID from Request (makes sure its the last ID for nested resources)
            $id = $this->getCurrentEntryId() ?? $id;
            $entry = $this->getEntry($id);

            $this->data = array();
            // get the info for that entry
            $this->data['title']        = $this->getTitle() ?? trans('cesi::core.crud.edit') . ' ' . $this->entity_name;
            $this->data['heading']      = $this->getHeading() ?? $this->entity_name_plural;
            $this->data['subheading']   = $this->getSubheading() ?? trans('cesi::core.crud.edit').' '.$this->entity_name;
            $this->data['entry']        = $entry;
            $this->data['contentClass'] = $this->getEditContentClass();
            $this->data['routerAlias']      = $this->getRouterAlias();
            $this->data['resourceAlias']    = $this->getResourceAlias();
            $this->data['hasUploadFields']  = $this->hasUploadFields('update', $entry->getKey());

            // TODO ?? $this->data['saveAction'] = $this->getSaveAction();
            // $this->data['fields'] = $this->getCrud()->getUpdateFields($id);

            $this->data['id'] = $id;

            // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
            return view($this->getEditView(), $this->filterEditViewData($this->data));
        } else {
            return view('cesi::errors.401');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function editModal($id)
    {
        $this->setOperation('update');
        if ($this->tienePermiso('update')) {
            // get entry ID from Request (makes sure its the last ID for nested resources)
            $id = $this->getCurrentEntryId() ?? $id;
            $entry = $this->getEntry($id);

            // get the info for that entry
            $this->data['title']        = $this->getTitle() ?? trans('cesi::core.crud.edit') . ' ' . $this->entity_name;
            $this->data['heading']      = $this->getHeading() ?? $this->entity_name_plural;
            $this->data['subheading']   = $this->getSubheading() ?? trans('cesi::core.crud.edit').' '.$this->entity_name;
            $this->data['entry']        = $entry;
            $this->data['contentClass'] = $this->getEditContentClass();
            $this->data['routerAlias']      = $this->getRouterAlias();
            $this->data['resourceAlias']    = $this->getResourceAlias();
            $this->data['hasUploadFields']  = $this->hasUploadFields('update', $entry->getKey());

            // TODO ?? $this->data['saveAction'] = $this->getSaveAction();
            // $this->data['fields'] = $this->getCrud()->getUpdateFields($id);

            $this->data['id'] = $id;

            return view($this->getEditModalView(), $this->filterEditViewData($this->data));
        } else {
            throw new AuthorizationException(trans('cesi::core.crud.unauthorized_access'));
            // return view('cesi::errors.401');
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        if ($this->tienePermiso('update')) {
            $record = $this->getModel()::findOrFail($id);

            $newValues = $this->getValuesToSave($request);
            $request->merge($newValues);
            $this->checkValidate($request, 'update', $record);

            if ($record->update($this->alterValuesToSave($request, $newValues, $id))) {
                // flash()->success(trans('cesicore.update_data_success'));
                return $this->getRedirectAfterSave($record, $request, 'update');
            } else {
                // flash()->error(trans('cesicore.update_data_failed'));
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
    }

    /**
     * Cargar valores para cuando estamos editando
     *
     * @param array $data
     * @return array
     */
    public function filterEditViewData($data = [])
    {
        return $data;
    }

    /**
     * @param $record
     */
    public function AfterUpdate($record)
    {
    }
}