<?php

use App\Models\CesiUser;
use Cesi\Core\app\Models\Role;
use Illuminate\Database\Seeder;

class CesiCoreUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line("Default Guard:" . config('auth.defaults.guard'));

        $this->command->line("Comprovando Role super-admin");

        $roleSAdm = Role::where('name', '=', 'super-admin')->first();
        if ($roleSAdm === null) {
            $roleSAdm   = Role::create(['name' => 'super-admin', 'guard_name' => 'web']);
        }

        $roleAdm = Role::where('name', '=', 'admin')->first();
        if ($roleAdm === null) {
            $roleAdm = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        }

        $roleUsr = Role::where('name', '=', 'usuario')->first();
        if ($roleUsr === null) {
            $roleUsr = Role::create(['name' => 'usuario', 'guard_name' => 'web']);
        }

        $userRoot = CesiUser::where('email', '=', 'admin@cesigrup.com')->first();
        if ($userRoot === null) {
            $userRoot = CesiUser::create([
                'name' => 'Admin Cesi',
                'email' => 'admin@cesigrup.com',
                'password' => bcrypt('cesi270360'),
            ]);

            // $userRoot->assignRole(['super-admin', 'admin', 'usuario']);
        }

        $userAdm = CesiUser::where('email', '=', 'admin@demo.com')->first();
        if ($userAdm === null) {
            $userAdm = CesiUser::create([
                'name' => 'Usuario Admin',
                'email' => 'admin@demo.com',
                'password' => bcrypt('admin'),
            ]);
            // $userAdm->assignRole(['admin', 'usuario']);
        }

        $userUser = CesiUser::where('email', '=', 'demo@demo.com')->first();
        if ($userUser === null) {
            $userUser = CesiUser::create([
                'name' => 'Usuario Demo',
                'email' => 'demo@demo.com',
                'password' => bcrypt('demo'),
            ]);
            // $userUser->assignRole(['usuario']);
        }

        $userRoot->roles()->sync([$roleSAdm->id, $roleAdm->id, $roleUsr->id], false);
        $userAdm->roles()->sync([$roleAdm->id, $roleUsr->id], false);
        $userUser->roles()->sync($roleUsr->id, false);
        // $userRoot->assignRole('super-admin');
        // $userRoot->assignRole($roleSAdm);

        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }
}