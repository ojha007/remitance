<?php

namespace Modules\Backend\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesSeeder extends Seeder
{

    public function run()
    {
        $states = [
            "Australian Capital Territory",
            "New South Wales",
            "Northern Territory",
            "Queensland",
            "South Australia",
            "Tasmania",
            "Victoria",
            "Western Australia",
        ];
        $country = DB::table('countries')->where('name', '=', 'Australia')->first();
        foreach ($states as $state) {
            DB::table('states')
                ->updateOrInsert(['name' => $state, 'country_id' => $country->id],
                    ['name' => $state, 'country_id' => $country->id]);
        }
        $allStates = DB::table('states')->where('country_id', '=', $country->id)->get();
        $suburbs = [
            0 => "Aarons Pass,New South Wales, 2850",
            1 => "Abba River,Western Australia, 6280",
            2 => "Abbey,Western Australia, 6280",
            3 => "Abbeyard,Victoria, 3737",
            4 => "Abbeywood,Queensland, 4613",
            5 => "Abbotsbury,New South Wales, 2176",
            6 => "Abbotsford,New South Wales, 2046",
            7 => "Abbotsford,Queensland, 4670",
            8 => "Abbotsford,Victoria, 3067",
            9 => "Abbotsham,Tasmania, 7315",
            10 => "Abels Bay,Tasmania, 7112",
            11 => "Abercorn,Queensland, 4627",
            12 => "Abercrombie,New South Wales, 2795",
            13 => "Abercrombie River,New South Wales, 2795",
            14 => "Aberdare,New South Wales, 2325",
            15 => "Aberdeen,New South Wales, 2336",
            16 => "Aberdeen,Tasmania, 7310",
            17 => "Aberfeldie,Victoria, 3040",
            18 => "Aberfeldy,Victoria, 3825",
            19 => "Aberfoyle,New South Wales, 2350",
            20 => "Aberfoyle Park,South Australia, 5159",
            21 => "Aberglasslyn,New South Wales, 2320",
            22 => "Abergowrie,Queensland, 4850",
            23 => "Abermain,New South Wales, 2326",
            24 => "Abernethy,New South Wales, 2325",
            25 => "Abingdon Downs,Queensland, 4892",
            26 => "Abington,New South Wales, 2350",
            27 => "Abington,Queensland, 4660",
            28 => "Acacia Creek,New South Wales, 2476",
            29 => "Acacia Gardens,New South Wales, 2763",
            30 => "Acacia Hills,Northern Territory, 822",
            31 => "Acacia Hills,Tasmania, 7306",
            32 => "Acacia Ridge,Queensland, 4110",
            33 => "Acheron,Victoria, 3714",
            34 => "Acland,Queensland, 4401",
            35 => "Acton,Australian Capital Territory, 2601",
            36 => "Acton,Tasmania, 7320",
            37 => "Acton Park,Tasmania, 7170",
            38 => "Acton Park,Western Australia, 6280",
            39 => "Ada,Victoria, 3833",
            40 => "Adaminaby,New South Wales, 2629",
            41 => "Adams Estate,Victoria, 3984",
            42 => "Adamstown,New South Wales, 2289",
            43 => "Adamstown Heights,New South Wales, 2289",
            44 => "Adamsvale,Western Australia, 6375",
            45 => "Adare,Queensland, 4343",
            46 => "Adavale,Queensland, 4474",
            47 => "Addington,Victoria, 3352",
            48 => "Adelaide,South Australia, 5000",
            49 => "Adelaide Airport,South Australia, 5950",
            50 => "Adelaide Lead,Victoria, 3465",
            51 => "Adelaide Park,Queensland, 4703",
            52 => "Adelaide River,Northern Territory, 846",
            53 => "Adelong,New South Wales, 2729",
            54 => "Adjungbilly,New South Wales, 2727",
            55 => "Advancetown,Queensland, 4211",
            56 => "Adventure Bay,Tasmania, 7150",
            57 => "Aeroglen,Queensland, 4870",
            58 => "Afterlee,New South Wales, 2474",
            59 => "Agery,South Australia, 5558",
            60 => "Agnes,Victoria, 3962",
            61 => "Agnes Banks,New South Wales, 2753",
            62 => "Agnes Water,Queensland, 4677",
            63 => "Ainslie,Australian Capital Territory, 2602",
            64 => "Airdmillan,Queensland, 4807",
            65 => "Airds,New South Wales, 2560",
            66 => "Aire Valley,Victoria, 3237",
            67 => "Aireys Inlet,Victoria, 3231",
            68 => "Airlie Beach,Queensland, 4802",
            69 => "Airly,Victoria, 3851",
            70 => "Airport West,Victoria, 3042",
            71 => "Airville,Queensland, 4807",
            72 => "Aitkenvale,Queensland, 4814",
            73 => "Ajana,Western Australia, 6532",
            74 => "Akaroa,Tasmania, 7216",
            75 => "Akolele,New South Wales, 2546",
            76 => "Alabama Hill,Queensland, 4820",
            77 => "Alawa,Northern Territory, 810",
            78 => "Alawoona,South Australia, 5311",
            79 => "Albacutya,Victoria, 3424",
            80 => "Albanvale,Victoria, 3021",
            81 => "Albany,Western Australia, 6330",
            82 => "Albany Creek,Queensland, 4035",
            83 => "Albert,New South Wales, 2873",
            84 => "Alberta,Queensland, 4702",
            85 => "Alberton,Queensland, 4207",
            86 => "Alberton,South Australia, 5014",
            87 => "Alberton,Tasmania, 7263",
            88 => "Alberton,Victoria, 3971",
            89 => "Alberton West,Victoria, 3971",
            90 => "Albert Park,South Australia, 5014",
            91 => "Albert Park,Victoria, 3206",
            92 => "Albinia,Queensland, 4722",
            93 => "Albion,Queensland, 4010",
            94 => "Albion,Queensland, 4822",
            95 => "Albion,Victoria, 3020",
            96 => "Albion Park,New South Wales, 2527",
            97 => "Albion Park Rail,New South Wales, 2527",
            98 => "Albury,New South Wales, 2640",
            99 => "Alcomie,Tasmania, 7330",
            100 => "Aldavilla,New South Wales, 2440",
            101 => "Alderley,Queensland, 4051",
            102 => "Aldershot,Queensland, 4650",
            103 => "Aldersyde,Western Australia, 6306",
            104 => "Aldgate,South Australia, 5154",
            105 => "Aldinga,South Australia, 5173",
            106 => "Aldinga Beach,South Australia, 5173",
            107 => "Aldoga,Queensland, 4694",
            108 => "Alectown,New South Wales, 2870",
            109 => "Alexander Heights,Western Australia, 6064",
            110 => "Alexandra,Queensland, 4740",
            111 => "Alexandra,Victoria, 3714",
            112 => "Alexandra Bridge,Western Australia, 6288",
            113 => "Alexandra Headland,Queensland, 4572",
            114 => "Alexandra Hills,Queensland, 4161",
            115 => "Alexandria,New South Wales, 2015",
            116 => "Alford,South Australia, 5555",
            117 => "Alfords Point,New South Wales, 2234",
            118 => "Alfred Cove,Western Australia, 6154",
            119 => "Alfredton,Victoria, 3350",
            120 => "Alfredtown,New South Wales, 2650",
            121 => "Algester,Queensland, 4115",
            122 => "Alice,New South Wales, 2469",
            123 => "Alice Creek,Queensland, 4610",
            124 => "Alice River,Queensland, 4817",
            125 => "Alice Springs,Northern Territory, 870",
            126 => "Ali Curung,Northern Territory, 872",
            127 => "Alison,New South Wales, 2259",
            128 => "Alison,New South Wales, 2420",
            129 => "Alkimos,Western Australia, 6038",
            130 => "Allambee,Victoria, 3823",
            131 => "Allambee Reserve,Victoria, 3871",
            132 => "Allambee South,Victoria, 3871",
            133 => "Allambie Heights,New South Wales, 2100",
            134 => "Allan,Queensland, 4370",
            135 => "Allandale,New South Wales, 2320",
            136 => "Allandale,Queensland, 4310",
            137 => "Allanooka,Western Australia, 6525",
            138 => "Allans Flat,Victoria, 3691",
            139 => "Allansford,Victoria, 3277",
            140 => "Allanson,Western Australia, 6225",
            141 => "Allawah,New South Wales, 2218",
            142 => "Alleena,New South Wales, 2671",
            143 => "Allenby Gardens,South Australia, 5009",
            144 => "Allendale,Victoria, 3364",
            145 => "Allendale East,South Australia, 5291",
            146 => "Allendale North,South Australia, 5373",
            147 => "Allens Rivulet,Tasmania, 7150",
            148 => "Allenstown,Queensland, 4700",
            149 => "Allenview,Queensland, 4285",
            150 => "Allestree,Victoria, 3305",
            151 => "Allgomera,New South Wales, 2441",
            152 => "Alligator Creek,Queensland, 4740",
            153 => "Alligator Creek,Queensland, 4816",
            154 => "Allora,Queensland, 4362",
            155 => "Alloway,Queensland, 4670",
            156 => "Allworth,New South Wales, 2425",
            157 => "Allynbrook,New South Wales, 2311",
            158 => "Alma,South Australia, 5401",
            159 => "Alma,Victoria, 3465",
            160 => "Alma,Western Australia, 6535",
            161 => "Almaden,Queensland, 4871",
            162 => "Alma Park,New South Wales, 2659",
            163 => "Almonds,Victoria, 3727",
            164 => "Almurta,Victoria, 3979",
            165 => "Alonnah,Tasmania, 7150",
            166 => "Aloomba,Queensland, 4871",
            167 => "Alpha,Queensland, 4724",
            168 => "Alphington,Victoria, 3078",
            169 => "Alpine,New South Wales, 2575",
            170 => "Alpurrurulam,Northern Territory, 4825",
            171 => "Alsace,Queensland, 4702",
            172 => "Alstonvale,New South Wales, 2477",
            173 => "Alstonville,New South Wales, 2477",
            174 => "Altona,South Australia, 5351",
            175 => "Altona,Victoria, 3018",
            176 => "Altona Meadows,Victoria, 3028",
            177 => "Altona North,Victoria, 3025",
            178 => "Alton Downs,Queensland, 4702",
            179 => "Alumy Creek,New South Wales, 2460",
            180 => "Alva,Queensland, 4807",
            181 => "Alvie,Victoria, 3249",
            182 => "Alyangula,Northern Territory, 885",
            183 => "Amamoor,Queensland, 4570",
            184 => "Amamoor Creek,Queensland, 4570",
            185 => "Amaroo,Australian Capital Territory, 2914",
            186 => "Amaroo,New South Wales, 2866",
            187 => "Amaroo,Queensland, 4829",
            188 => "Amata,South Australia, 872",
            189 => "Ambania,Western Australia, 6632",
            190 => "Ambarvale,New South Wales, 2560",
            191 => "Amber,Queensland, 4871",
            192 => "Ambergate,Western Australia, 6280",
            193 => "Amberley,Queensland, 4306",
            194 => "Ambleside,Tasmania, 7310",
            195 => "Ambrose,Queensland, 4695",
            196 => "Amby,Queensland, 4462",
            197 => "Amelup,Western Australia, 6338",
            198 => "American Beach,South Australia, 5222",
            199 => "American River,South Australia, 5221",
            200 => "Amherst,Victoria, 3371",
            201 => "Amiens,Queensland, 4380",
            202 => "Amity,Queensland, 4183",
            203 => "Amoonguna,Northern Territory, 873",
            204 => "Amor,Victoria, 3825",
            205 => "Amosfield,New South Wales, 4380",
            206 => "Amphitheatre,Victoria, 3468",
            207 => "Ampilatwatja,Northern Territory, 872",
            208 => "Amyton,South Australia, 5431",
            209 => "Anabranch North,New South Wales, 2648",
            210 => "Anabranch South,New South Wales, 2648",
            211 => "Anakie,Victoria, 3213",
            212 => "Anama,South Australia, 5464",
            213 => "Anambah,New South Wales, 2320",
            214 => "Anangu Pitjantjatjara Yankunytjatjara,South Australia, 872",
            215 => "Anatye,Northern Territory, 872",
            216 => "Ancona,Victoria, 3715",
            217 => "Andamooka,South Australia, 5722",
            218 => "Andamooka Station,South Australia, 5719",
            219 => "Andergrove,Queensland, 4740",
            220 => "Anderleigh,Queensland, 4570",
            221 => "Anderson,Victoria, 3995",
            222 => "Ando,New South Wales, 2631",
            223 => "Andover,Tasmania, 7120",
            224 => "Andrews,South Australia, 5454",
            225 => "Andrews Farm,South Australia, 5114",
            226 => "Andromache,Queensland, 4800",
            227 => "Anduramba,Queensland, 4355",
            228 => "Anembo,New South Wales, 2621",
            229 => "Angas Plains,South Australia, 5255",
            230 => "Angaston,South Australia, 5353",
            231 => "Angas Valley,South Australia, 5238",
            232 => "Angelo River,Western Australia, 6642",
            233 => "Angledale,New South Wales, 2550",
            234 => "Angledool,New South Wales, 2834",
            235 => "Angle Park,South Australia, 5010",
            236 => "Anglers Reach,New South Wales, 2629",
            237 => "Anglers Rest,Victoria, 3898",
            238 => "Anglesea,Victoria, 3230",
            239 => "Angle Vale,South Australia, 5117",
            240 => "Angourie,New South Wales, 2464",
            241 => "Angurugu,Northern Territory, 822",
            242 => "Anindilyakwa,Northern Territory, 822",
            243 => "Anketell,Western Australia, 6167",
            244 => "Anmatjere,Northern Territory, 872",
            245 => "Anna Bay,New South Wales, 2316",
            246 => "Annadale,South Australia, 5356",
            247 => "Annandale,New South Wales, 2038",
            248 => "Annandale,Queensland, 4814",
            249 => "Annangrove,New South Wales, 2156",
            250 => "Annerley,Queensland, 4103",
            251 => "Anniebrook,Western Australia, 6280",
            252 => "Annuello,Victoria, 3549",
            253 => "Ansons Bay,Tasmania, 7264",
            254 => "Anstead,Queensland, 4070",
            255 => "Antechamber Bay,South Australia, 5222",
            256 => "Anthony,Queensland, 4310",
            257 => "Antigua,Queensland, 4650",
            258 => "Antill Ponds,Tasmania, 7120",
            259 => "Antonymyre,Western Australia, 6714",
            260 => "Antwerp,Victoria, 3414",
            261 => "Anula,Northern Territory, 812",
            262 => "Apamurra,South Australia, 5237",
            263 => "Apoinga,South Australia, 5413",
            264 => "Apollo Bay,Tasmania, 7150",
            265 => "Apollo Bay,Victoria, 3233",
            266 => "Appila,South Australia, 5480",
            267 => "Appin,New South Wales, 2560",
            268 => "Appin,Victoria, 3579",
            269 => "Appin South,Victoria, 3579",
            270 => "Appleby,New South Wales, 2340",
            271 => "Applecross,Western Australia, 6153",
            272 => "Applethorpe,Queensland, 4378",
            273 => "Apple Tree Creek,Queensland, 4660",
            274 => "Appletree Flat,New South Wales, 2330",
            275 => "Apple Tree Flat,New South Wales, 2850",
            276 => "Apslawn,Tasmania, 7190",
            277 => "Apsley,New South Wales, 2820",
            278 => "Apsley,Tasmania, 7030",
            279 => "Apsley,Victoria, 3319",
            280 => "Arable,New South Wales, 2630",
            281 => "Arakoon,New South Wales, 2431",
            282 => "Araluen,New South Wales, 2622",
            283 => "Araluen,Northern Territory, 870",
            284 => "Araluen,Queensland, 4570",
            285 => "Aramac,Queensland, 4726",
            286 => "Aramara,Queensland, 4620",
            287 => "Arana Hills,Queensland, 4054",
            288 => "Aranbanga,Queensland, 4625",
            289 => "Aranda,Australian Capital Territory, 2614",
            290 => "Ararat,Victoria, 3377",
            291 => "Aratula,New South Wales, 2714",
            292 => "Aratula,Queensland, 4309",
            293 => "Arawata,Victoria, 3951",
            294 => "Arbouin,Queensland, 4892",
            295 => "Arbuckle,Victoria, 3858",
            296 => "Arcadia,New South Wales, 2159",
            297 => "Arcadia,Queensland, 4819",
            298 => "Arcadia,Victoria, 3631",
            299 => "Arcadia South,Victoria, 3631",
            300 => "Arcadia Vale,New South Wales, 2283",
            301 => "Arcadia Valley,Queensland, 4702",
            302 => "Archdale,Victoria, 3475",
            303 => "Archdale Junction,Victoria, 3475",
            304 => "Archer,Northern Territory, 830",
            305 => "Archerfield,Queensland, 4108",
            306 => "Archer River,Queensland, 4892",
            307 => "Archerton,Victoria, 3723",
            308 => "Archies Creek,Victoria, 3995",
            309 => "Arcoona,South Australia, 5720",
            310 => "Arcturus,Queensland, 4722",
            311 => "Ardath,Western Australia, 6419",
            312 => "Ardeer,Victoria, 3022",
            313 => "Ardglen,New South Wales, 2338",
            314 => "Arding,New South Wales, 2358",
            315 => "Ardlethan,New South Wales, 2665",
            316 => "Ardmona,Victoria, 3629",
            317 => "Ardross,Western Australia, 6153",
            318 => "Ardrossan,South Australia, 5571",
            319 => "Areegra,Victoria, 3480",
            320 => "Areyonga,Northern Territory, 872",
            321 => "Argalong,New South Wales, 2720",
            322 => "Argenton,New South Wales, 2284",
            323 => "Argents Hill,New South Wales, 2449",
            324 => "Argoon,New South Wales, 2707",
            325 => "Argoon,Queensland, 4702",
            326 => "Argyle,Victoria, 3523",
            327 => "Argyle,Western Australia, 6239",
            328 => "Argyll,Queensland, 4721",
            329 => "Ariah Park,New South Wales, 2665",
            330 => "Arkaroola Village,South Australia, 5732",
            331 => "Arkell,New South Wales, 2795",
            332 => "Arkstone,New South Wales, 2795",
            333 => "Armadale,Victoria, 3143",
            334 => "Armadale,Western Australia, 6112",
            335 => "Armagh,South Australia, 5453",
            336 => "Armatree,New South Wales, 2828",
            337 => "Armidale,New South Wales, 2350",
            338 => "Armstrong,Victoria, 3377",
            339 => "Armstrong Beach,Queensland, 4737",
            340 => "Armstrong Creek,Queensland, 4520",
            341 => "Armstrong Creek,Victoria, 3217",
            342 => "Arncliffe,New South Wales, 2205",
            343 => "Arndell Park,New South Wales, 2148",
            344 => "Arno Bay,South Australia, 5603",
            345 => "Arnold,Northern Territory, 852",
            346 => "Arnold,Victoria, 3551",
            347 => "Arnold West,Victoria, 3551",
            348 => "Aroona,Queensland, 4551",
            349 => "Arrawarra,New South Wales, 2456",
            350 => "Arrawarra Headland,New South Wales, 2456",
            351 => "Arriga,Queensland, 4880",
            352 => "Arrino,Western Australia, 6519",
            353 => "Arrowsmith,Western Australia, 6525",
            354 => "Arrowsmith East,Western Australia, 6519",
            355 => "Artarmon,New South Wales, 2064",
            356 => "Arthur River,Tasmania, 7330",
            357 => "Arthur River,Western Australia, 6315",
            358 => "Arthurs Creek,Victoria, 3099",
            359 => "Arthurs Lake,Tasmania, 7030",
            360 => "Arthurs Seat,Victoria, 3936",
            361 => "Arthurton,South Australia, 5572",
            362 => "Arthurville,New South Wales, 2820",
            363 => "Arumbera,Northern Territory, 873",
            364 => "Arumpo,New South Wales, 2715",
            365 => "Arundel,Queensland, 4214",
            366 => "Ascot,Queensland, 4007",
            367 => "Ascot,Queensland, 4360",
            368 => "Ascot,Victoria, 3364",
            369 => "Ascot,Victoria, 3551",
            370 => "Ascot,Western Australia, 6104",
            371 => "Ascot Park,South Australia, 5043",
            372 => "Ascot Vale,Victoria, 3032",
            373 => "Ashbourne,South Australia, 5157",
            374 => "Ashbourne,Victoria, 3442",
            375 => "Ashburton,Victoria, 3147",
            376 => "Ashbury,New South Wales, 2193",
            377 => "Ashby,New South Wales, 2463",
            378 => "Ashby,Western Australia, 6065",
            379 => "Ashby Heights,New South Wales, 2463",
            380 => "Ashby Island,New South Wales, 2463",
            381 => "Ashcroft,New South Wales, 2168",
            382 => "Ashendon,Western Australia, 6111",
            383 => "Ashfield,New South Wales, 2131",
            384 => "Ashfield,Queensland, 4670",
            385 => "Ashfield,Western Australia, 6054",
            386 => "Ashford,New South Wales, 2361",
            387 => "Ashford,South Australia, 5035",
            388 => "Ashgrove,Queensland, 4060",
            389 => "Ashley,New South Wales, 2400",
            390 => "Ashmont,New South Wales, 2650",
            391 => "Ashmore,Queensland, 4214",
            392 => "Ashton,South Australia, 5137",
            393 => "Ashtonfield,New South Wales, 2323",
            394 => "Ashville,South Australia, 5259",
            395 => "Ashwell,Queensland, 4340",
            396 => "Ashwood,Victoria, 3147",
            397 => "Aspendale,Victoria, 3195",
            398 => "Aspendale Gardens,Victoria, 3195",
            399 => "Aspley,Queensland, 4034",
            400 => "Asquith,New South Wales, 2077",
            401 => "Athelstone,South Australia, 5076",
            402 => "Atherton,Queensland, 4883",
            403 => "Athlone,Victoria, 3818",
            404 => "Athol,Queensland, 4350",
            405 => "Athol Park,South Australia, 5012",
            406 => "Atholwood,New South Wales, 2361",
            407 => "Atitjere,Northern Territory, 872",
            408 => "Atkinsons Dam,Queensland, 4311",
            409 => "Attadale,Western Australia, 6156",
            410 => "Attunga,New South Wales, 2345",
            411 => "Attwood,Victoria, 3049",
            412 => "Atwell,Western Australia, 6164",
            413 => "Aubigny,Queensland, 4401",
            414 => "Aubin Grove,Western Australia, 6164",
            415 => "Aubrey,Victoria, 3393",
            416 => "Auburn,New South Wales, 2144",
            417 => "Auburn,Queensland, 4413",
            418 => "Auburn,South Australia, 5451",
            419 => "Auburn Vale,New South Wales, 2360",
            420 => "Auchenflower,Queensland, 4066",
            421 => "Auchmore,Victoria, 3570",
            422 => "Augathella,Queensland, 4477",
            423 => "Augusta,Western Australia, 6290",
            424 => "Augustine Heights,Queensland, 4300",
            425 => "Auldana,South Australia, 5072",
            426 => "Aurukun,Queensland, 4892",
            427 => "Austinmer,New South Wales, 2515",
            428 => "Austins Ferry,Tasmania, 7011",
            429 => "Austinville,Queensland, 4213",
            430 => "Austral,New South Wales, 2179",
            431 => "Austral Eden,New South Wales, 2440",
            432 => "Australia Plains,South Australia, 5374",
            433 => "Australind,Western Australia, 6233",
            434 => "Avalon,Victoria, 3212",
            435 => "Avalon Beach,New South Wales, 2107",
            436 => "Aveley,Western Australia, 6069",
            437 => "Avenel,Victoria, 3664",
            438 => "Avenell Heights,Queensland, 4670",
            439 => "Avenue Range,South Australia, 5273",
            440 => "Avisford,New South Wales, 2850",
            441 => "Avoca,New South Wales, 2577",
            442 => "Avoca,Queensland, 4670",
            443 => "Avoca,Tasmania, 7213",
            444 => "Avoca,Victoria, 3467",
            445 => "Avoca Beach,New South Wales, 2251",
            446 => "Avoca Dell,South Australia, 5253",
            447 => "Avoca Vale,Queensland, 4314",
            448 => "Avon,New South Wales, 2574",
            449 => "Avon,South Australia, 5501",
            450 => "Avondale,New South Wales, 2530",
            451 => "Avondale,Queensland, 4670",
            452 => "Avondale Heights,Victoria, 3034",
            453 => "Avonmore,Victoria, 3559",
            454 => "Avon Plains,Victoria, 3477",
            455 => "Avonside,New South Wales, 2628",
            456 => "Avonsleigh,Victoria, 3782",
            457 => "Avon Valley National Park,Western Australia, 6084",
            458 => "Awaba,New South Wales, 2283",
            459 => "Axe Creek,Victoria, 3551",
            460 => "Axedale,Victoria, 3551",
            461 => "Aylmerton,New South Wales, 2575",
            462 => "Ayr,Queensland, 4807",
            463 => "Ayrford,Victoria, 3268",
        ];
        foreach ($suburbs as $sub) {
            $array = explode(',', $sub);
            $state = $allStates->where('name', '=', $array[1])->first();
            DB::table('suburbs')
                ->updateOrInsert(
                    [
                        'name' => $array[0],
                        'post_code' => $array[2],
                        'state_id' => $state ? $state->id : 1
                    ],
                    [
                        'name' => $array[0],
                        'post_code' => $array[2],
                        'state_id' => $state ? $state->id : 1
                    ]
                );
        }
        $id_types = [
            'Photo ID',
            'Passport',
            'CitizenShip',
            'Driving License',
        ];
        foreach ($id_types as $id) {
            DB::table('identity_types')
                ->updateOrInsert([
                    'name' => $id
                ], ['name' => $id]);
        }
    }
}
