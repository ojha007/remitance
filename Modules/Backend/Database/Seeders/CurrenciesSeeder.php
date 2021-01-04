<?php

namespace Modules\Backend\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesSeeder extends Seeder
{

    public function run()
    {
        $currencies = [
            ['name' => 'Nepalese Rupees', 'code' => 'NPR'],
            ['name' => 'Austrian Dollar', 'code' => 'AUD'],
        ];
        foreach ($currencies as $currency) {
            DB::table('currencies')
                ->updateOrInsert(
                    ['name' => $currency['name'], 'code' => $currency['code']],

                    ['name' => $currency['name'], 'code' => $currency['code']]);
        }
    }
}
