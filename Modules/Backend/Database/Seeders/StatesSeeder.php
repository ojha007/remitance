<?php

namespace Modules\Backend\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class StatesSeeder extends Seeder
{

    public function run()
    {
        $ausStates = [
            "Australian Capital Territory",
            "New South Wales",
            "Northern Territory",
            "Queensland",
            "South Australia",
            "Tasmania",
            "Victoria",
            "Western Australia",
        ];

        $aus = DB::table('countries')
            ->where('name', '=', 'Australia')->first();
        $nepal = DB::table('countries')
            ->where('name', '=', 'Nepal')
            ->first();
        $allStates = DB::table('states')
            ->where('country_id', '=', $aus->id)
            ->get();

        $nepalAll = [
            'Province No. 1' => [
                'Bhojpur' => [],
                'Dhankuta' => [],
                'Ilam' => [],
                'Jhapa' => [],
                'Khotang' => [],
                'Morang' => [],
                'Okhaldhunga' => [],
                'Panchthar' => [],
                'Sankhuwasabha' => [],
                'Solukhumbu ' => [],
                'Sunsari' => [
                    'Itahari Sub Metropolitan City',
                    'Dharan Sub Metropolitan City',
                    'Inaruwa Municipality',
                    'Duhabi Municipality',
                    'Ramdhuni Municipality',
                    'Barahachhetra Municipality',
                    'Koshi Rural Municipality',
                    'Gadhi Rural Municipality',
                    'Barju Rural Municipality',
                    'Bhokraha Narashingh Rural Municipality',
                    'Harinagara Rural Municipality',
                    'Dewanganj Rural Municipality'
                ],
                'Taplejung ' => [],
                'Terhathum ' => [],
                'Udayapur' => [],
            ],
            'Province No. 2' => [
                'Bara' => [],
                'Dhanusha' => [],
                'Mahottari' => [],
                'Parsa' => [],
                'Rautahat' => [],
                'Saptari' => [],
                'Sarlahi' => [],
                'Siraha' => [],
            ],
            'Bagmati Province' => [
                'Bhaktapur' => [
                    'BHAKTAPUR MUNICIPALITY',
                    'CHANGUNARAYAN MUNICIPALITY',
                    'MADHYAPUR THIMI MUNICIPALITY',
                    'SURYABINAYAK MUNICIPALITY',
                ],
                'Chitwan ' => [
                    'BHARATPUR METROPOLITAN',
                    'ICHCHHYAKAMANA RURAL MUNICIPALITY',
                    'KALIKA MUNICIPALITY',
                    'KHAIRAHANI MUNICIPALITY',
                    'MADI MUNICIPALITY',
                    'RAPTI MUNICIPALITY',
                    'RATNANAGAR MUNICIPALITY',
                ],
                'Dhading' => [
                    'BENIGHAT RORANG RURAL MUNICIPALITY',
                    'DHUNIBESI MUNICIPALITY',
                    'GAJURI RURAL MUNICIPALITY',
                    'GALCHI RURAL MUNICIPALITY',
                    'GANGAJAMUNA RURAL MUNICIPALITY',
                    'JWALAMUKHI RURAL MUNICIPALITY',
                    'KHANIYABASH RURAL MUNICIPALITY',
                    'NETRAWATI RURAL MUNICIPALITY',
                    'NILAKANTHA MUNICIPALITY',
                    'RUBI VALLEY RURAL MUNICIPALITY',
                    'SIDDHALEK RURAL MUNICIPALITY',
                    'THAKRE RURAL MUNICIPALITY',
                    'TRIPURA SUNDARI RURAL MUNICIPALITY'
                ],
                'Dolakha' => [
                    'BAITESHWOR RURAL MUNICIPALITY',
                    'BHIMESHWOR MUNICIPALITY',
                    'BIGU RURAL MUNICIPALITY',
                    'GAURISHANKAR RURAL MUNICIPALITY',
                    'JIRI MUNICIPALITY',
                    'KALINCHOK RURAL MUNICIPALITY',
                    'MELUNG RURAL MUNICIPALITY',
                    'SAILUNG RURAL MUNICIPALITY',
                    'TAMAKOSHI RURAL MUNICIPALITY',
                ],
                'Kathmandu' => [
                    'BUDHANILAKANTHA MUNICIPALITY',
                    'CHANDRAGIRI MUNICIPALITY',
                    'DAKSHINKALI MUNICIPALITY',
                    'GOKARNESHWOR MUNICIPALITY',
                    'KAGESHWORI MANAHARA MUNICIPALITY',
                    'KATHMANDU METROPOLITAN',
                    'KIRTIPUR MUNICIPALITY',
                    'NAGARJUN MUNICIPALITY',
                    'SHANKHARAPUR MUNICIPALITY',
                    'TARAKESHWOR MUNICIPALITY',
                    'TOKHA MUNICIPALITY',
                ],
                'Kavrepalanchok ' => [
                    'BANEPA MUNICIPALITY',
                    'BETHANCHOWK RURAL MUNICIPALITY',
                    'BHUMLU RURAL MUNICIPALITY',
                    'CHAURIDEURALI RURAL MUNICIPALITY',
                    'DHULIKHEL MUNICIPALITY',
                    'KHANIKHOLA RURAL MUNICIPALITY',
                    'MAHABHARAT RURAL MUNICIPALITY',
                    'MANDANDEUPUR MUNICIPALITY',
                    'NAMOBUDDHA MUNICIPALITY',
                    'PANAUTIBIHABAR MUNICIPALITY',
                    'PANCHKHAL MUNICIPALITY',
                    'ROSHI RURAL MUNICIPALITY',
                    'TEMAL RURAL MUNICIPALITY'
                ],
                'Lalitpur ' => [
                    'BAGMATI RURAL MUNICIPALITY',
                    'GODAWARI MUNICIPALITY',
                    'KONJYOSOM RURAL MUNICIPALITY',
                    'LALITPUR METROPOLITAN',
                    'MAHALAXMI MUNICIPALITY',
                    'MAHANKAL RURAL MUNICIPALITY'
                ],
                'Makwanpur ' => [],
                'Nuwakot ' => [],
                'Ramechhap ' => [
                    'DORAMBA RURAL MUNICIPALITY',
                    'GOKULGANGA RURAL MUNICIPALITY',
                    'KHADADEVI RURAL MUNICIPALITY',
                    'LIKHU RURAL MUNICIPALITY',
                    'MANTHALI MUNICIPALITY',
                    'RAMECHHAP MUNICIPALITY',
                    'SUNAPATI RURAL MUNICIPALITY',
                    'UMAKUNDA RURAL MUNICIPALITY',
                ],
                'Rasuwa ' => [],
                'Sindhuli ' => [
                    'Kamalamai Municipality',
                    'Dudhauli Municipality',
                    'Sunkoshi Rural Municipality',
                    'Hariharpur Gadhi Rural Municipality',
                    'Tinpatan Rural Municipality',
                    'Marin Rural Municipality',
                    'Golanjor Rural Municipality',
                    'Phikkal Rural Municipality',
                    'Ghyanglekh Rural Municipality',
                ],
                'Sindhupalchok ' => [],
            ],
            'Gandaki Province' => [
                'Baglung' => [],
                'Gorkha' => [],
                'Kaski' => [
                    'Pokhara Metropolitan City',
                    'Annapurna Rural Municipality',
                    'Machhapuchchhre Rural Municipality',
                    'Madi Rural Municipality',
                    'Rupa Rural Municipality',
                ],
                'Lamjung' => [],
                'Manang' => [],
                'Mustang' => [],
                'Myagdi' => [],
                'Nawalpur' => [],
                'Parbat' => [],
                'Syangja' => [],
                'Tanahun' => [],
            ],
            'Lumbini Province' => [
                'Arghakhanchi' => [],
                'Banke' => [],
                'Bardiya' => [],
                'Dang Deukhuri' => [],
                'Eastern Rukum' => [],
                'Gulmi' => [],
                'Kapilvastu' => [],
                'Parasi' => [],
                'Palpa' => [],
                'Pyuthan' => [],
                'Rolpa' => [],
                'Rupandehi' => [],
            ],
            'Karnali Province' => [
                'Dailekh' => [],
                'Dolpa' => [],
                'Humla' => [],
                'Jajarkot' => [],
                'Jumla' => [],
                'Kalikot' => [],
                'Mugu' => [],
                'Salyan' => [],
                'Surkhet' => [],
                'Western Rukum' => [],
            ],
            'Sudurpashchim Province' => [
                'Achham' => [
                    'BANNIGADHI JAYAGADH RURAL MUNICIPALITY',
                    'CHAURPATI RURAL MUNICIPALITY',
                    'DHAKARI RURAL MUNICIPALITY',
                    'KAMALBAZAR MUNICIPALITY',
                    'MANGALSEN MUNICIPALITY',
                    'MELLEKH RURAL MUNICIPALITY',
                    'PANCHADEWAL BINAYAK MUNICIPALITY',
                    'RAMAROSHAN RURAL MUNICIPALITY',
                    'SANPHEBAGAR MUNICIPALITY',
                    'TURMAKHAD RURAL MUNICIPALITY'
                ],
                'Baitadi' => [],
                'Bajhang' => [],
                'Bajura' => [],
                'Dadeldhura' => [],
                'Darchula' => [],
                'Doti' => [],
                'Kailali' => [],
                'Kanchanpur' => [],
            ]
        ];
        $id_types = [
            'Photo ID',
            'Passport',
            'Citizenship',
            'Driving License',
        ];
        foreach ($id_types as $id) {
            DB::table('identity_types')
                ->updateOrInsert([
                    'name' => $id
                ], ['name' => $id]);
        }
        foreach ($nepalAll as $state => $districts) {
            DB::table('states')
                ->updateOrInsert(['name' => $state, 'country_id' => $nepal->id],
                    ['name' => $state, 'country_id' => $nepal->id]);
            $state_id = DB::table('states')
                ->where('name', '=', $state)
                ->first()->id;
            foreach ($districts as $district => $vdcs) {
                DB::table('districts')
                    ->updateOrInsert(['name' => $district, 'state_id' => $state_id],
                        ['name' => $district, 'state_id' => $state_id]);
//                $district_id = DB::table('districts')
//                    ->where('name', '=', $district)
//                    ->first()->id;
//                foreach ($vdcs as $vdc) {
//                    DB::table('municipalities')
//                        ->updateOrInsert(['name' => $vdc, 'district_id' => $district_id],
//                            ['name' => $vdc, 'district_id' => $district_id]);
//                }
            }

        }

        $suburbs = Http::get('https://raw.githubusercontent.com/michalsn/australian-suburbs/master/data/suburbs.json')->json()['data'];
        foreach ($suburbs as $key => $sub) {
            $state = DB::table('states')
                ->where('name', $sub['state_name'])
                ->first();
            if (!$state) {
                $state_id = DB::table('states')
                    ->insertGetId(['name' => $sub['state_name'], 'country_id' => $aus->id]);
            }
            $id = $state ? $state->id : $state_id;
            DB::table('suburbs')
                ->updateOrInsert(
                    [
                        'name' => $sub['suburb'],
                        'post_code' => $sub['postcode'],
                        'state_id' => $id
                    ],
                    [
                        'name' => $sub['suburb'],
                        'post_code' => $sub['postcode'],
                        'state_id' => $id
                    ],
                );
        }
    }

}
