<?php
namespace Cesi\Core\app\Http\Controllers\Admin;

use Cesi\Core\app\Models\Permission;
use Cesi\Core\libs\Controllers\CrudController;
use Illuminate\Http\Request;

class RoleCrudController extends CrudController
{
    /**
     * @throws \Exception
     */
    public function setup()
    {
        $role_model = config('cesi.core.permissionmanager.models.role');
        $permission_model = config('cesi.core.permissionmanager.models.permission');

        $this->setModel($role_model);
        $this->setEntityNameStrings(trans('cesi::core.permissionmanager.role'), trans('cesi::core.permissionmanager.role'));
        $this->setRoute(cesi_url('core.role'));
        $this->setRouterAlias('admin.core.role');
        $this->setResourceAlias('cesi::core.admin.roles');
        $this->setPermissionName('admin.core.role');

        $this->setDefaultOrderColumn('name');
        $this->setDefaultOrderDirection('asc');

        parent::setup();
    }

    public function initColumns()
    {
        // Columns.
        $this->setColumns([
            [
                'name'  => 'name',
                'label' => trans('cesi::core.permissionmanager.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'guard_name',
                'label' => trans('cesi::core.permissionmanager.guard_type'),
                'type'  => 'text',
            ]
        ]);
    }

    /**
     * @param array $data
     * @return array
     */
    public function filterCreateViewData($data = [])
    {
        $data['permisos'] = Permission::get()->sortByDesc('name');
        return $data;
    }

    /**
     * @param array $data
     * @return array
     */
    public function filterEditViewData($data = [])
    {
        $data['permisos'] = Permission::get()->sortByDesc('name');
        return $data;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param null $record
     * @return array
     */
    public function getValuesToSave(Request $request, $record = null)
    {
        $values = [];
        $values['name'] = $request->input('name', '');

        return $values;
    }

    /**
     * Redirecciona a la vista ".list" despues de guardar los datos
     *
     * @param $record
     * @param \Illuminate\Http\Request $request
     * @param String tipo
     *
     * @return \Illuminate\Http\Response
     */
    public function getRedirectAfterSave($record, Request $request, $tipo = null)
    {
        $req_permissions = $request['permission'];

        if (isset($req_permissions)) {
            $record->permissions()->sync($req_permissions);
        } else {
            $record->permissions()->detach();
        }
        return parent::getRedirectAfterSave($record, $request, $tipo);
    }
}