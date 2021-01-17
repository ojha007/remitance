<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Backend\Http\Services\GlobalServices;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guard = 'admin';
        $permissions = (new GlobalServices())->getAllPermissions();
        Permission::firstOrCreate(['name' => 'admin-permission', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'transaction-notification', 'guard_name' => $guard]);
        Permission::firstOrCreate(['name' => 'admin-permission', 'guard_name' => $guard]);
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name'], 'guard_name' => $guard]);

        }
        $role = Role::firstOrCreate(['name' => 'Administrator', 'guard_name' => $guard]);
        $permissions = Permission::where('guard_name', '=', $guard)->get();
        $role->syncPermissions($permissions);
    }
}
