<?php
namespace Cesi\Core\app\Http\Controllers\Admin;

use Cesi\Core\app\Models\Permission;
use Cesi\Core\app\Models\Role;
use Cesi\Core\libs\Controllers\CrudController;
use Illuminate\Http\Request;

class PermissionController extends CrudController
{
    /**
     * @throws \Exception
     */
    public function setup()
    {
        $this->setModel(Permission::class);
        $this->setEntityNameStrings(trans('cesi::core.permissionmanager.permission_singular'), trans('cesi::core.permissionmanager.permission_plural'));
        $this->setRoute(cesi_url('core.permission'));
        $this->setRouterAlias('admin.core.permission');
        $this->setResourceAlias('cesi::core.admin.permissions');
        $this->setPermissionName('admin.core.permission');

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
            ], [ // n-n relationship (with pivot table)
                'label'     => trans('cesi::core.permissionmanager.roles'), // Table column heading
                'type'      => 'select_multiple',
                'orderable' => false,
                'name'      => 'roles', // the method that defines the relationship in your Model
                'entidad'   => 'roles', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => config('permission.models.role'), // foreign key model
            ],
        ]);
    }

    /**
     * @param array $data
     * @return array
     */
    public function filterCreateViewData($data = [])
    {
        $data['roles'] = Role::get();
        return $data;
    }

    /**
     * @param array $data
     * @return array
     */
    public function filterEditViewData($data = [])
    {
        $data['roles'] = Role::get();
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
        $roles = $request['roles'];

        if (isset($roles)) {
            $record->roles()->sync($roles);
        } else {
            $record->roles()->detach();
        }
        return parent::getRedirectAfterSave($record, $request, $tipo);
    }
}