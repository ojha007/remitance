<?php

namespace Modules\Backend\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypeSeeder extends Seeder
{

    public function run()
    {
        $paymentTypes = [
            'Local Remit',
            'Bank Transfer',
            'Cash On Hand',
        ];
        foreach ($paymentTypes as $paymentType) {
            DB::table('payment_types')
                ->updateOrInsert(
                    ['name' => $paymentType], ['name' => $paymentType]);
        }
    }
}
