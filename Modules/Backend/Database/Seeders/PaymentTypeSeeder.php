<?php

namespace Modules\Backend\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\PaymentType;
use Modules\Backend\Entities\SendMoney;

class PaymentTypeSeeder extends Seeder
{

    public function run()
    {
        $paymentTypes = PaymentType::getPaymentTypes();
        foreach ($paymentTypes as $paymentType) {
            DB::table('payment_types')
                ->updateOrInsert(
                    ['name' => $paymentType], ['name' => $paymentType]);
        }
        $statues = SendMoney::getAllTransactionStatues();
        foreach ($statues as $status) {
            DB::table('statuses')
                ->updateOrInsert([
                    'name' => $status,
                ], ['name' => $status]);
        }
    }
}
