<?php

namespace Modules\Backend\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanksSeeder extends Seeder
{

    public function run()
    {
        $banks = [
            'Agricultural Development Bank',
            'Bank of Kathmandu Ltd',
            'Century Commercial Bank Ltd',
            'Citizens Bank International Ltd',
            'Civil Bank Ltd',
            'Deva Bikas Bank Limited',
            'Everest Bank Ltd',
            'Gandaki Bikas Bank Ltd  ',
            'Garima Bikas Bank Limited',
            'Global IME Bank Ltd',
            'Himalayan Bank Ltd',
            'Janata Bank Nepal Ltd',
            'Jyoti Bikash Bank Ltd',
            'Kailash Bikas Bank Limited',
            'Kamana Sewa Bikas Bank Ltd',
            'Kumari Bank Ltd',
            'Laxmi Bank Ltd',
            'Lumbini Bikas Bank Ltd',
            'Machhapuchchhre Bank Ltd',
            'Mahalaxmi Bikash Bank Ltd.',
            'Mega Bank Nepal Ltd',
            'Muktinath Bikas Bank Limited',
            'Nabil Bank Ltd',
            'NCC Bank Ltd',
            'Nepal Bangladesh Bank Ltd',
            'Nepal Bank Limited',
            'Nepal Investment Bank Limited',
            'Nepal Rastra Bank',
            'Nepal SBI Bank Ltd',
            'NIC ASIA Bank Ltd',
            'NMB Bank Ltd',
            'Om Development Bank Limited',
            'Prabhu Bank Ltd',
            'Prime Commercial Bank Ltd',
            'Rastriya Banijya Bank Ltd',
            'Sanima Bank Ltd',
            'Shangrila Development Bank Limited',
            'Siddhartha Bank Ltd',
            'Standard Chartered Bank Nepal Ltd',
            'Sunrise Bank Ltd'
        ];
        foreach ($banks as $bank) {
            DB::table('banks')
                ->updateOrInsert(['name' => $bank],
                    ['name' => $bank]);
        }
    }
}
