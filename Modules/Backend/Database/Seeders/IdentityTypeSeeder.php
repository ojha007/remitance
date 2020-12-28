<?php

namespace Modules\Backend\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdentityTypeSeeder extends Seeder
{


    public function run()
    {
        $items = [
            "Australian Capital Territory",
            "New South Wales",
            "Northern Territory",
            "Queensland",
            "South Australia",
            "Tasmania",
            "Victoria",
            "Western Australia",


        ];
        foreach ($items as $item) {
            DB::table('identity_types')
                ->updateOrInsert([
                    'name' => $item
                ], ['name' => $item]);
        }

    }


}
