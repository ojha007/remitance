<?php

namespace Modules\Backend\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class BackendDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call([
            CountriesSeeder::class,
            BanksSeeder::class,
            StatesSeeder::class,
            CurrenciesSeeder::class,
            PaymentTypeSeeder::class,
        ]);
    }
}
