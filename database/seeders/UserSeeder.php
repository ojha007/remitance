<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superUser = User::updateOrCreate(
            ['email' => 'admin@registeredremit.com.au'],
            ['name' => 'Admin',
                'password' => Hash::make('admin@1997'),
                'is_super' => true,
//                'is_active' => true
            ]);
        if (!$superUser->hasRole('Administrator', 'admin')) {
            $superUser->assignRole('Administrator', 'admin');

        }
        if (!$superUser->hasPermissionTo('admin-permission', 'admin'))
            $superUser->givePermissionTo('admin-permission', 'admin');
    }
}
