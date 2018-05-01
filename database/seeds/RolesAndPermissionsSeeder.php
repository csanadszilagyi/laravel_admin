<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'see users']);
        Permission::create(['name' => 'see editors']);
        Permission::create(['name' => 'see admins']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('see users');

        $role = Role::create(['name' => 'editor']);
        $role->givePermissionTo('see editors');

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
