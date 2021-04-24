<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'users',
            'sales',
            'billing'
        ];

        $permissionsRow = [];
        foreach ($permissions as $permission) {
            $permissionsRow[] = Permission::create(['group' => $permission, 'name' => $permission . '.read']);
            $permissionsRow[] = Permission::create(['group' => $permission, 'name' => $permission . '.edit']);
            $permissionsRow[] = Permission::create(['group' => $permission, 'name' => $permission . '.delete']);
        }

        $dev = Role::create(['name' => 'dev']);
        $admin = Role::create(['name' => 'admin']);

        foreach ($permissionsRow as $p) {
            $dev->givePermissionTo($p);
            $admin->givePermissionTo($p);
        }
    }
}
