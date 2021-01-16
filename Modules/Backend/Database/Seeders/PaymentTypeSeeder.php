<?php

namespace Modules\Backend\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\SendMoney;

class PaymentTypeSeeder extends Seeder
{

    const LOCAL_REMIT = 'Local Remit';
    const BANK_TRANSFER = 'Bank Transfer';
    const CASH_ON_HAND = 'Cash On Hand';

    public function run()
    {
        $paymentTypes = [
            self::LOCAL_REMIT,
            self::BANK_TRANSFER,
            self::CASH_ON_HAND,

        ];
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
