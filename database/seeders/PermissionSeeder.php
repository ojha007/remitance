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
        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission['name'], $guard);

        }
        Permission::findOrCreate('admin-permission', $guard);
        $role = Role::firstOrCreate(['name' => 'Administrator', 'guard_name' => $guard]);
        $permissions = Permission::where('guard_name', '=', $guard)->get();
        $role->syncPermissions($permissions);
    }
}
