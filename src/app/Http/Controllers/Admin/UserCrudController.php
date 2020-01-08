<?php
namespace Cesi\Core\app\Http\Controllers\Admin;

use Cesi\Core\app\Models\Role;
use Cesi\Core\libs\Controllers\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserCrudController extends CrudController
{

    public function setup()
    {
        $this->setModel(config('cesi.core.permissionmanager.models.user'));
        $this->setEntityNameStrings(trans('cesi::core.permissionmanager.user'), trans('cesi::core.permissionmanager.users'));
        $this->setRoute(cesi_url('core.user'));
        $this->setRouterAlias('admin.core.user');
        $this->setResourceAlias('cesi::core.admin.users');
        $this->setPermissionName('admin.core.user');

        $this->setDefaultOrderColumn('name');
        $this->setDefaultOrderDirection('asc');

        $this->initFilters();

        parent::setup();
    }

    public function initFilters() {

        $this->addFilter([
            'name'  => 'fltStatus',
            'label' => trans('cesi::core.permissionmanager.fields_user.status'),
            'type'  => 'select2',
            'datos' => [
                '0' => '-Todos-',
                '1' => 'Activo',
                '2' => 'Desactivado',
            ],
            'style' => 'width:190px;',
            'placeholder' => trans('cesi::core.permissionmanager.fields_user.status'),
            'queryName' => 'users.status',
        ], false, function($myQuery, $value) {
            $valor = intval($value);
            if ($valor==0) {
                // nothing todo
            } else if ($valor==1) {
                $myQuery->where('users.status', '=', 1);
            } else if ($valor==2) {
                $myQuery->where('users.status', '=', 0);
            }
        });
    }

    public function initColumns()
    {
        // Columns.
        $this->setColumns([
            [
                'name'  => 'name',
                'label' => trans('cesi::core.permissionmanager.name'),
                'type'  => 'text',
            ], [
                'name'  => 'email',
                'label' => trans('cesi::core.permissionmanager.email'),
                'type'  => 'email',
            ], [ // n-n relationship (with pivot table)
                'label'     => trans('cesi::core.permissionmanager.roles'), // Table column heading
                'type'      => 'select_multiple',
                'name'      => 'roles', // the method that defines the relationship in your Model
                'entity'    => 'roles', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => config('permission.models.role'), // foreign key model
            ], [
                'name'  => 'status',
                'label' => trans('cesi::core.permissionmanager.fields_user.status'),
                'type'  => 'sino',
            ]
        ]);
    }

    /**
     * Classes using this trait have to implement this method.
     * Used to validate store.
     *
     * @return array
     */
    public function StoreValidationData()
    {
        return [
            'rules' => [
                'name' => 'required|min:3|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|confirmed|min:6',
            ],
            'messages' => [],
            'attributes' => [],
            'advanced' => [],
        ];
    }

    /**
     * Classes using this trait have to implement this method.
     * Used to validate update.
     *
     * @param $record
     * @return array
     */
    public function UpdateValidationData($record)
    {
        return [
            'rules' => [
                'name' => 'required|min:3|max:255',
                'email' => 'required|email|max:255|unique:users,email,'.$record->id,
                'password' => 'nullable|confirmed|min:6',
            ],
            'messages' => [],
            'attributes' => [],
            'advanced' => [],
        ];
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
        $creating = is_null($record);
        $values = [];
        $values['name']     = $request->input('name', '');
        $values['email']    = $request->input('email', '');
        $values['status']   = $request->input('status', 0);

        // dd($request);
        // dd($values);

        // If creating user or providing password.
        $password = $request->input('password', null);
        if ($creating || !empty($password)) {
            $values['password'] = $password;
        }

        return $values;
    }

    public function alterValuesToSave(Request $request, $values, $id = null)
    {
        if (array_key_exists('password', $values)) {
            if (!empty($values['password'])) {
                $values['password'] = Hash::make($values['password']);
            } else {
                unset($values['password']);
            }
        }

        if (!array_key_exists('status', $values)) {
            $values['status'] = 0;
        }

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