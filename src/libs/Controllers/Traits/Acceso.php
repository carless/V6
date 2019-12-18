<?php
namespace Cesi\Core\libs\Controllers\Traits;

use Cesi\Core\app\Http\Controllers\Exceptions\AccessDeniedException;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

trait Acceso
{
    protected $guard_name = 'web';
    protected $permission_name = '';

    public $access = ['list', 'create', 'update', 'delete'];

    /**
     * @return string
     */
    public function getGuardName(): string
    {
        return $this->guard_name;
    }

    /**
     * @param string $guard_name
     */
    public function setGuardName(string $guard_name)
    {
        $this->guard_name = $guard_name;
    }

    /**
     * @return string
     */
    public function getPermissionName(): string
    {
        if (empty($this->permission_name)) {
            $name = $this->getRouterAlias();
            $name = str_replace('/', '.', $name);
            $name = str_replace('\\', '.', $name);
            $this->permission_name = $name;
        }
        return $this->permission_name;
    }

    /**
     * @param string $permission_name
     */
    public function setPermissionName(string $permission_name)
    {
        $this->permission_name = $permission_name;
    }

    /**
     * @param string $action
     *
     * @return bool
     */
    public function tienePermiso($action = '')
    {
        if (empty($action)) {
            $action = $this->getAction();
        }

        // Check to spatie
        $namePermission = $this->getPermissionName() . "." . $action;
        $p = Permission::findOrCreate($namePermission, $this->getGuardName());
        $user = cesi_user();

        if($user->hasPermissionTo($p)) {
            return true;
        } else {
            if ($user && $user->hasRole('super-admin')) {
                $roleSAdm = Role::findByName('super-admin');
                $roleSAdm->givePermissionTo($p);

                return true;
            }
        }

        /*
        if(($p && $user && $user->hasPermissionTo($p)) || !$p) {
            return true;
        } else {
            if ($user && $user->hasRole('super-admin')) {
                $roleSAdm = Role::findByName('super-admin');
                $roleSAdm->givePermissionTo($p);

                return true;
            }
        }
        */

        return false;
    }

    /**
     * Comprobar si hay un permiso habilitado para el CrudPanel. Devuelve falso si no.
     *
     * @param string $permission Permission.
     * @deprecated  use tienePermiso
     *
     * @return bool
     */
    public function hasAccess($permission)
    {
        if (! in_array($permission, $this->access)) {
            return false;
        }

        return true;
    }

    /**
     * Comprobar si hay algún permiso habilitado para el CrudPanel. Devuelve falso si no.
     *
     * @param array $permission_array Permissions.
     *
     * @return bool
     */
    public function hasAccessToAny($permission_array)
    {
        foreach ($permission_array as $key => $permission) {
            if (in_array($permission, $this->access)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Comprobar si todos los permisos están habilitados para el CrudPanel. Devuelve falso si no.
     *
     * @param array $permission_array Permissions.
     *
     * @return bool
     */
    public function hasAccessToAll($permission_array)
    {
        foreach ($permission_array as $key => $permission) {
            if (! in_array($permission, $this->access)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Comprobar si hay un permiso habilitado para el CrudPanel. Falla si no.
     *
     * @param string $permission Permission
     *
     * @return bool
     *
     * @throws AccessDeniedException in case the permission is not enabled
     */
    public function hasAccessOrFail($permission)
    {
        if (! in_array($permission, $this->access)) {
            throw new AccessDeniedException(trans('cesi::core.crud.unauthorized_access', ['access' => $permission]));
        }

        return true;
    }

    /**
     *
     * @param $user
     */
    public function iniciarPermisos($user)
    {
        // dd($this->accessActions);

        foreach ($this->access as $accion) {
            // echo "Permission Name : " . $this->getPermissionName() . "." . $accion . "<br/>";
            // echo "Guard Name : " . $this->getGuardName() . "<br/>";

            $p = Permission::findOrCreate($this->getPermissionName() . "." . $accion , $this->getGuardName());

            // if(($p && $user && $user->hasPermissionTo($p)) || !$p) {
            if($user->hasPermissionTo($p)) {
                // return true
            } else {
                if ($user && $user->hasRole('super-admin')) {
                    $roleSAdm = Role::findByName('super-admin');
                    $roleSAdm->givePermissionTo($p);

                    // return true;
                }
            }
        }

        // die();
    }
}