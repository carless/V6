<?php

use Cesi\Core\app\Models\CoreMenu;
use Cesi\Core\app\Models\Permission;
use Cesi\Core\app\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CesiCoreMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line("Generando Menus");
        DB::table('core_menu')->truncate();

        $menuRoot = CoreMenu::create([
            'id'            => '1',
            'name'          => 'root',
            'type'          => 'root',
            'icon'          => '',
            'is_protected'  => '1',
        ]);
        $menuRoot->saveAsRoot();

        $this->command->line("Root Menu Generado");

        $menuDashboard = CoreMenu::create([
            'id'            => '2',
            'name'          => 'Dashboard',
            'type'          => 'route',
            'link'          => 'admin.dashboard',
            'icon'          => 'fa-tachometer-alt',
            'is_protected'  => '1',
        ]);
        $menuRoot->appendNode($menuDashboard);

        $menuAdmin = CoreMenu::create([
            'id'            => '3',
            'name'          => 'Administration',
            'type'          => 'separator',
            'link'          => '',
            'icon'          => 'fa-users',
            'is_protected'  => '1',
        ]);

        $menuRoot->appendNode($menuAdmin);

        $menuUsers = CoreMenu::create([
            'id'            => '4',
            'name'          => 'Usuarios',
            'type'          => 'route',
            'link'          => 'admin.core.users.list',
            'icon'          => 'fa-user',
            'is_protected'  => '1',
        ]);
        $menuAdmin->appendNode($menuUsers);
        $this->createPermissions('core.users');

        $menuRoles = CoreMenu::create([
            'id'            => '5',
            'name'          => 'Roles',
            'type'          => 'route',
            'link'          => 'admin.core.roles.list',
            'icon'          => 'fa-user-circle',
            'is_protected'  => '1',
        ]);
        $menuAdmin->appendNode($menuRoles);
        $this->createPermissions('core.roles');

        $menuPermisions = CoreMenu::create([
            'id'            => '6',
            'name'          => 'Permisos',
            'type'          => 'route',
            'link'          => 'admin.core.permissions.list',
            'icon'          => 'fa-key',
            'is_protected'  => '1',
        ]);
        $menuAdmin->appendNode($menuPermisions);
        $this->createPermissions('core.permissions');

        $menuMenus = CoreMenu::create([
            'id'            => '7',
            'name'          => 'Menus',
            'type'          => 'route',
            'link'          => 'admin.core.menus.list',
            'icon'          => 'fa-th-list',
            'is_protected'  => '1',
        ]);
        $menuAdmin->appendNode($menuMenus);
        $this->createPermissions('core.menus');
    }

    public function createPermissions($name)
    {
        $rolusuario     = Role::findByName('super-admin');
        $p_item_list    = Permission::findOrCreate('admin.'.$name.'.list');

        $rolusuario->givePermissionTo($p_item_list);
    }
}