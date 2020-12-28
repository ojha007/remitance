<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\Sender;
use Modules\Backend\Http\Requests\SenderRequest;
use Modules\Backend\Http\Response\ErrorResponse;
use Modules\Backend\Http\Response\SuccessResponse;
use Modules\Backend\Http\Services\DataTableButton;
use Modules\Backend\Repositories\SenderRepository;
use Yajra\DataTables\DataTables;

class SenderController extends Controller
{

    protected $viewPath = 'backend::senders.';

    protected $baseRoute = 'admin.senders.';

    private $model;
    /**
     * @var SenderRepository
     */
    private $repository;


    public function __construct(Sender $sender)
    {
        $this->model = $sender;
        $this->repository = new SenderRepository($sender);
    }


    public function index(Request $request)
    {

        if ($request->ajax()) {
            $rates = $this->repository->select('id', 'date', 'customer_rate', 'agent_rate');
            return $this->dataTableLists($rates);
        }
        return view($this->viewPath . 'index');
    }

    protected function dataTableLists(Collection $collection)
    {
        $dataTableButton = new DataTableButton();
        return DataTables::make($collection)
            ->addColumn('action', function ($rate) use ($dataTableButton) {
                $button = '';
                $button .= $dataTableButton->editButton($this->baseRoute . 'edit', $rate->id);
                $button .= $dataTableButton->deleteButton($this->baseRoute . 'destroy', $rate->id);
                return $button;
            })
            ->toJson();
    }


    public function create()
    {
        $c=[];
       $a = array (

            1 =>
                array (
                    0 => '1',
                    1 => 'Aarons Pass',
                    2 => 'New South Wales',
                    3 => ' 2850',
                    4 => ' ',
                ),
            2 =>
                array (
                    0 => '2',
                    1 => 'Abba River',
                    2 => 'Western Australia',
                    3 => ' 6280',
                    4 => ' ',
                ),
            3 =>
                array (
                    0 => '3',
                    1 => 'Abbey',
                    2 => 'Western Australia',
                    3 => ' 6280',
                    4 => ' ',
                ),
            4 =>
                array (
                    0 => '4',
                    1 => 'Abbeyard',
                    2 => 'Victoria',
                    3 => ' 3737',
                    4 => ' ',
                ),
            5 =>
                array (
                    0 => '5',
                    1 => 'Abbeywood',
                    2 => 'Queensland',
                    3 => ' 4613',
                    4 => ' ',
                ),
            6 =>
                array (
                    0 => '6',
                    1 => 'Abbotsbury',
                    2 => 'New South Wales',
                    3 => ' 2176',
                    4 => ' ',
                ),
            7 =>
                array (
                    0 => '7',
                    1 => 'Abbotsford',
                    2 => 'New South Wales',
                    3 => ' 2046',
                    4 => ' ',
                ),
            8 =>
                array (
                    0 => '8',
                    1 => 'Abbotsford',
                    2 => 'Queensland',
                    3 => ' 4670',
                    4 => ' ',
                ),
            9 =>
                array (
                    0 => '9',
                    1 => 'Abbotsford',
                    2 => 'Victoria',
                    3 => ' 3067',
                    4 => ' ',
                ),
            10 =>
                array (
                    0 => '10',
                    1 => 'Abbotsham',
                    2 => 'Tasmania',
                    3 => ' 7315',
                    4 => ' ',
                ),
            11 =>
                array (
                    0 => '11',
                    1 => 'Abels Bay',
                    2 => 'Tasmania',
                    3 => ' 7112',
                    4 => ' ',
                ),
            12 =>
                array (
                    0 => '12',
                    1 => 'Abercorn',
                    2 => 'Queensland',
                    3 => ' 4627',
                    4 => ' ',
                ),
            13 =>
                array (
                    0 => '13',
                    1 => 'Abercrombie',
                    2 => 'New South Wales',
                    3 => ' 2795',
                    4 => ' ',
                ),
            14 =>
                array (
                    0 => '14',
                    1 => 'Abercrombie River',
                    2 => 'New South Wales',
                    3 => ' 2795',
                    4 => ' ',
                ),
            15 =>
                array (
                    0 => '15',
                    1 => 'Aberdare',
                    2 => 'New South Wales',
                    3 => ' 2325',
                    4 => ' ',
                ),
            16 =>
                array (
                    0 => '16',
                    1 => 'Aberdeen',
                    2 => 'New South Wales',
                    3 => ' 2336',
                    4 => ' ',
                ),
            17 =>
                array (
                    0 => '17',
                    1 => 'Aberdeen',
                    2 => 'Tasmania',
                    3 => ' 7310',
                    4 => ' ',
                ),
            18 =>
                array (
                    0 => '18',
                    1 => 'Aberfeldie',
                    2 => 'Victoria',
                    3 => ' 3040',
                    4 => ' ',
                ),
            19 =>
                array (
                    0 => '19',
                    1 => 'Aberfeldy',
                    2 => 'Victoria',
                    3 => ' 3825',
                    4 => ' ',
                ),
            20 =>
                array (
                    0 => '20',
                    1 => 'Aberfoyle',
                    2 => 'New South Wales',
                    3 => ' 2350',
                    4 => ' ',
                ),
            21 =>
                array (
                    0 => '21',
                    1 => 'Aberfoyle Park',
                    2 => 'South Australia',
                    3 => ' 5159',
                    4 => ' ',
                ),
            22 =>
                array (
                    0 => '22',
                    1 => 'Aberglasslyn',
                    2 => 'New South Wales',
                    3 => ' 2320',
                    4 => ' ',
                ),
            23 =>
                array (
                    0 => '23',
                    1 => 'Abergowrie',
                    2 => 'Queensland',
                    3 => ' 4850',
                    4 => ' ',
                ),
            24 =>
                array (
                    0 => '24',
                    1 => 'Abermain',
                    2 => 'New South Wales',
                    3 => ' 2326',
                    4 => ' ',
                ),
            25 =>
                array (
                    0 => '25',
                    1 => 'Abernethy',
                    2 => 'New South Wales',
                    3 => ' 2325',
                    4 => ' ',
                ),
            26 =>
                array (
                    0 => '26',
                    1 => 'Abingdon Downs',
                    2 => 'Queensland',
                    3 => ' 4892',
                    4 => ' ',
                ),
            27 =>
                array (
                    0 => '27',
                    1 => 'Abington',
                    2 => 'New South Wales',
                    3 => ' 2350',
                    4 => ' ',
                ),
            28 =>
                array (
                    0 => '28',
                    1 => 'Abington',
                    2 => 'Queensland',
                    3 => ' 4660',
                    4 => ' ',
                ),
            29 =>
                array (
                    0 => '29',
                    1 => 'Acacia Creek',
                    2 => 'New South Wales',
                    3 => ' 2476',
                    4 => ' ',
                ),
            30 =>
                array (
                    0 => '30',
                    1 => 'Acacia Gardens',
                    2 => 'New South Wales',
                    3 => ' 2763',
                    4 => ' ',
                ),
            31 =>
                array (
                    0 => '31',
                    1 => 'Acacia Hills',
                    2 => 'Northern Territory',
                    3 => ' 822',
                    4 => ' ',
                ),
            32 =>
                array (
                    0 => '32',
                    1 => 'Acacia Hills',
                    2 => 'Tasmania',
                    3 => ' 7306',
                    4 => ' ',
                ),
            33 =>
                array (
                    0 => '33',
                    1 => 'Acacia Ridge',
                    2 => 'Queensland',
                    3 => ' 4110',
                    4 => ' ',
                ),
            34 =>
                array (
                    0 => '34',
                    1 => 'Acheron',
                    2 => 'Victoria',
                    3 => ' 3714',
                    4 => ' ',
                ),
            35 =>
                array (
                    0 => '35',
                    1 => 'Acland',
                    2 => 'Queensland',
                    3 => ' 4401',
                    4 => ' ',
                ),
            36 =>
                array (
                    0 => '36',
                    1 => 'Acton',
                    2 => 'Australian Capital Territory',
                    3 => ' 2601',
                    4 => ' ',
                ),
            37 =>
                array (
                    0 => '37',
                    1 => 'Acton',
                    2 => 'Tasmania',
                    3 => ' 7320',
                    4 => ' ',
                ),
            38 =>
                array (
                    0 => '38',
                    1 => 'Acton Park',
                    2 => 'Tasmania',
                    3 => ' 7170',
                    4 => ' ',
                ),
            39 =>
                array (
                    0 => '39',
                    1 => 'Acton Park',
                    2 => 'Western Australia',
                    3 => ' 6280',
                    4 => ' ',
                ),
            40 =>
                array (
                    0 => '40',
                    1 => 'Ada',
                    2 => 'Victoria',
                    3 => ' 3833',
                    4 => ' ',
                ),
            41 =>
                array (
                    0 => '41',
                    1 => 'Adaminaby',
                    2 => 'New South Wales',
                    3 => ' 2629',
                    4 => ' ',
                ),
            42 =>
                array (
                    0 => '42',
                    1 => 'Adams Estate',
                    2 => 'Victoria',
                    3 => ' 3984',
                    4 => ' ',
                ),
            43 =>
                array (
                    0 => '43',
                    1 => 'Adamstown',
                    2 => 'New South Wales',
                    3 => ' 2289',
                    4 => ' ',
                ),
            44 =>
                array (
                    0 => '44',
                    1 => 'Adamstown Heights',
                    2 => 'New South Wales',
                    3 => ' 2289',
                    4 => ' ',
                ),
            45 =>
                array (
                    0 => '45',
                    1 => 'Adamsvale',
                    2 => 'Western Australia',
                    3 => ' 6375',
                    4 => ' ',
                ),
            46 =>
                array (
                    0 => '46',
                    1 => 'Adare',
                    2 => 'Queensland',
                    3 => ' 4343',
                    4 => ' ',
                ),
            47 =>
                array (
                    0 => '47',
                    1 => 'Adavale',
                    2 => 'Queensland',
                    3 => ' 4474',
                    4 => ' ',
                ),
            48 =>
                array (
                    0 => '48',
                    1 => 'Addington',
                    2 => 'Victoria',
                    3 => ' 3352',
                    4 => ' ',
                ),
            49 =>
                array (
                    0 => '49',
                    1 => 'Adelaide',
                    2 => 'South Australia',
                    3 => ' 5000',
                    4 => ' ',
                ),
            50 =>
                array (
                    0 => '50',
                    1 => 'Adelaide Airport',
                    2 => 'South Australia',
                    3 => ' 5950',
                    4 => ' ',
                ),
            51 =>
                array (
                    0 => '51',
                    1 => 'Adelaide Lead',
                    2 => 'Victoria',
                    3 => ' 3465',
                    4 => ' ',
                ),
            52 =>
                array (
                    0 => '52',
                    1 => 'Adelaide Park',
                    2 => 'Queensland',
                    3 => ' 4703',
                    4 => ' ',
                ),
            53 =>
                array (
                    0 => '53',
                    1 => 'Adelaide River',
                    2 => 'Northern Territory',
                    3 => ' 846',
                    4 => ' ',
                ),
            54 =>
                array (
                    0 => '54',
                    1 => 'Adelong',
                    2 => 'New South Wales',
                    3 => ' 2729',
                    4 => ' ',
                ),
            55 =>
                array (
                    0 => '55',
                    1 => 'Adjungbilly',
                    2 => 'New South Wales',
                    3 => ' 2727',
                    4 => ' ',
                ),
            56 =>
                array (
                    0 => '56',
                    1 => 'Advancetown',
                    2 => 'Queensland',
                    3 => ' 4211',
                    4 => ' ',
                ),
            57 =>
                array (
                    0 => '57',
                    1 => 'Adventure Bay',
                    2 => 'Tasmania',
                    3 => ' 7150',
                    4 => ' ',
                ),
            58 =>
                array (
                    0 => '58',
                    1 => 'Aeroglen',
                    2 => 'Queensland',
                    3 => ' 4870',
                    4 => ' ',
                ),
            59 =>
                array (
                    0 => '59',
                    1 => 'Afterlee',
                    2 => 'New South Wales',
                    3 => ' 2474',
                    4 => ' ',
                ),
            60 =>
                array (
                    0 => '60',
                    1 => 'Agery',
                    2 => 'South Australia',
                    3 => ' 5558',
                    4 => ' ',
                ),
            61 =>
                array (
                    0 => '61',
                    1 => 'Agnes',
                    2 => 'Victoria',
                    3 => ' 3962',
                    4 => ' ',
                ),
            62 =>
                array (
                    0 => '62',
                    1 => 'Agnes Banks',
                    2 => 'New South Wales',
                    3 => ' 2753',
                    4 => ' ',
                ),
            63 =>
                array (
                    0 => '63',
                    1 => 'Agnes Water',
                    2 => 'Queensland',
                    3 => ' 4677',
                    4 => ' ',
                ),
            64 =>
                array (
                    0 => '64',
                    1 => 'Ainslie',
                    2 => 'Australian Capital Territory',
                    3 => ' 2602',
                    4 => ' ',
                ),
            65 =>
                array (
                    0 => '65',
                    1 => 'Airdmillan',
                    2 => 'Queensland',
                    3 => ' 4807',
                    4 => ' ',
                ),
            66 =>
                array (
                    0 => '66',
                    1 => 'Airds',
                    2 => 'New South Wales',
                    3 => ' 2560',
                    4 => ' ',
                ),
            67 =>
                array (
                    0 => '67',
                    1 => 'Aire Valley',
                    2 => 'Victoria',
                    3 => ' 3237',
                    4 => ' ',
                ),
            68 =>
                array (
                    0 => '68',
                    1 => 'Aireys Inlet',
                    2 => 'Victoria',
                    3 => ' 3231',
                    4 => ' ',
                ),
            69 =>
                array (
                    0 => '69',
                    1 => 'Airlie Beach',
                    2 => 'Queensland',
                    3 => ' 4802',
                    4 => ' ',
                ),
            70 =>
                array (
                    0 => '70',
                    1 => 'Airly',
                    2 => 'Victoria',
                    3 => ' 3851',
                    4 => ' ',
                ),
            71 =>
                array (
                    0 => '71',
                    1 => 'Airport West',
                    2 => 'Victoria',
                    3 => ' 3042',
                    4 => ' ',
                ),
            72 =>
                array (
                    0 => '72',
                    1 => 'Airville',
                    2 => 'Queensland',
                    3 => ' 4807',
                    4 => ' ',
                ),
            73 =>
                array (
                    0 => '73',
                    1 => 'Aitkenvale',
                    2 => 'Queensland',
                    3 => ' 4814',
                    4 => ' ',
                ),
            74 =>
                array (
                    0 => '74',
                    1 => 'Ajana',
                    2 => 'Western Australia',
                    3 => ' 6532',
                    4 => ' ',
                ),
            75 =>
                array (
                    0 => '75',
                    1 => 'Akaroa',
                    2 => 'Tasmania',
                    3 => ' 7216',
                    4 => ' ',
                ),
            76 =>
                array (
                    0 => '76',
                    1 => 'Akolele',
                    2 => 'New South Wales',
                    3 => ' 2546',
                    4 => ' ',
                ),
            77 =>
                array (
                    0 => '77',
                    1 => 'Alabama Hill',
                    2 => 'Queensland',
                    3 => ' 4820',
                    4 => ' ',
                ),
            78 =>
                array (
                    0 => '78',
                    1 => 'Alawa',
                    2 => 'Northern Territory',
                    3 => ' 810',
                    4 => ' ',
                ),
            79 =>
                array (
                    0 => '79',
                    1 => 'Alawoona',
                    2 => 'South Australia',
                    3 => ' 5311',
                    4 => ' ',
                ),
            80 =>
                array (
                    0 => '80',
                    1 => 'Albacutya',
                    2 => 'Victoria',
                    3 => ' 3424',
                    4 => ' ',
                ),
            81 =>
                array (
                    0 => '81',
                    1 => 'Albanvale',
                    2 => 'Victoria',
                    3 => ' 3021',
                    4 => ' ',
                ),
            82 =>
                array (
                    0 => '82',
                    1 => 'Albany',
                    2 => 'Western Australia',
                    3 => ' 6330',
                    4 => ' ',
                ),
            83 =>
                array (
                    0 => '83',
                    1 => 'Albany Creek',
                    2 => 'Queensland',
                    3 => ' 4035',
                    4 => ' ',
                ),
            84 =>
                array (
                    0 => '84',
                    1 => 'Albert',
                    2 => 'New South Wales',
                    3 => ' 2873',
                    4 => ' ',
                ),
            85 =>
                array (
                    0 => '85',
                    1 => 'Alberta',
                    2 => 'Queensland',
                    3 => ' 4702',
                    4 => ' ',
                ),
            86 =>
                array (
                    0 => '86',
                    1 => 'Alberton',
                    2 => 'Queensland',
                    3 => ' 4207',
                    4 => ' ',
                ),
            87 =>
                array (
                    0 => '87',
                    1 => 'Alberton',
                    2 => 'South Australia',
                    3 => ' 5014',
                    4 => ' ',
                ),
            88 =>
                array (
                    0 => '88',
                    1 => 'Alberton',
                    2 => 'Tasmania',
                    3 => ' 7263',
                    4 => ' ',
                ),
            89 =>
                array (
                    0 => '89',
                    1 => 'Alberton',
                    2 => 'Victoria',
                    3 => ' 3971',
                    4 => ' ',
                ),
            90 =>
                array (
                    0 => '90',
                    1 => 'Alberton West',
                    2 => 'Victoria',
                    3 => ' 3971',
                    4 => ' ',
                ),
            91 =>
                array (
                    0 => '91',
                    1 => 'Albert Park',
                    2 => 'South Australia',
                    3 => ' 5014',
                    4 => ' ',
                ),
            92 =>
                array (
                    0 => '92',
                    1 => 'Albert Park',
                    2 => 'Victoria',
                    3 => ' 3206',
                    4 => ' ',
                ),
            93 =>
                array (
                    0 => '93',
                    1 => 'Albinia',
                    2 => 'Queensland',
                    3 => ' 4722',
                    4 => ' ',
                ),
            94 =>
                array (
                    0 => '94',
                    1 => 'Albion',
                    2 => 'Queensland',
                    3 => ' 4010',
                    4 => ' ',
                ),
            95 =>
                array (
                    0 => '95',
                    1 => 'Albion',
                    2 => 'Queensland',
                    3 => ' 4822',
                    4 => ' ',
                ),
            96 =>
                array (
                    0 => '96',
                    1 => 'Albion',
                    2 => 'Victoria',
                    3 => ' 3020',
                    4 => ' ',
                ),
            97 =>
                array (
                    0 => '97',
                    1 => 'Albion Park',
                    2 => 'New South Wales',
                    3 => ' 2527',
                    4 => ' ',
                ),
            98 =>
                array (
                    0 => '98',
                    1 => 'Albion Park Rail',
                    2 => 'New South Wales',
                    3 => ' 2527',
                    4 => ' ',
                ),
            99 =>
                array (
                    0 => '99',
                    1 => 'Albury',
                    2 => 'New South Wales',
                    3 => ' 2640',
                    4 => ' ',
                ),
            100 =>
                array (
                    0 => '100',
                    1 => 'Alcomie',
                    2 => 'Tasmania',
                    3 => ' 7330',
                    4 => ' ',
                ),
            101 =>
                array (
                    0 => '101',
                    1 => 'Aldavilla',
                    2 => 'New South Wales',
                    3 => ' 2440',
                    4 => ' ',
                ),
            102 =>
                array (
                    0 => '102',
                    1 => 'Alderley',
                    2 => 'Queensland',
                    3 => ' 4051',
                    4 => ' ',
                ),
            103 =>
                array (
                    0 => '103',
                    1 => 'Aldershot',
                    2 => 'Queensland',
                    3 => ' 4650',
                    4 => ' ',
                ),
            104 =>
                array (
                    0 => '104',
                    1 => 'Aldersyde',
                    2 => 'Western Australia',
                    3 => ' 6306',
                    4 => ' ',
                ),
            105 =>
                array (
                    0 => '105',
                    1 => 'Aldgate',
                    2 => 'South Australia',
                    3 => ' 5154',
                    4 => ' ',
                ),
            106 =>
                array (
                    0 => '106',
                    1 => 'Aldinga',
                    2 => 'South Australia',
                    3 => ' 5173',
                    4 => ' ',
                ),
            107 =>
                array (
                    0 => '107',
                    1 => 'Aldinga Beach',
                    2 => 'South Australia',
                    3 => ' 5173',
                    4 => ' ',
                ),
            108 =>
                array (
                    0 => '108',
                    1 => 'Aldoga',
                    2 => 'Queensland',
                    3 => ' 4694',
                    4 => ' ',
                ),
            109 =>
                array (
                    0 => '109',
                    1 => 'Alectown',
                    2 => 'New South Wales',
                    3 => ' 2870',
                    4 => ' ',
                ),
            110 =>
                array (
                    0 => '110',
                    1 => 'Alexander Heights',
                    2 => 'Western Australia',
                    3 => ' 6064',
                    4 => ' ',
                ),
            111 =>
                array (
                    0 => '111',
                    1 => 'Alexandra',
                    2 => 'Queensland',
                    3 => ' 4740',
                    4 => ' ',
                ),
            112 =>
                array (
                    0 => '112',
                    1 => 'Alexandra',
                    2 => 'Victoria',
                    3 => ' 3714',
                    4 => ' ',
                ),
            113 =>
                array (
                    0 => '113',
                    1 => 'Alexandra Bridge',
                    2 => 'Western Australia',
                    3 => ' 6288',
                    4 => ' ',
                ),
            114 =>
                array (
                    0 => '114',
                    1 => 'Alexandra Headland',
                    2 => 'Queensland',
                    3 => ' 4572',
                    4 => ' ',
                ),
            115 =>
                array (
                    0 => '115',
                    1 => 'Alexandra Hills',
                    2 => 'Queensland',
                    3 => ' 4161',
                    4 => ' ',
                ),
            116 =>
                array (
                    0 => '116',
                    1 => 'Alexandria',
                    2 => 'New South Wales',
                    3 => ' 2015',
                    4 => ' ',
                ),
            117 =>
                array (
                    0 => '117',
                    1 => 'Alford',
                    2 => 'South Australia',
                    3 => ' 5555',
                    4 => ' ',
                ),
            118 =>
                array (
                    0 => '118',
                    1 => 'Alfords Point',
                    2 => 'New South Wales',
                    3 => ' 2234',
                    4 => ' ',
                ),
            119 =>
                array (
                    0 => '119',
                    1 => 'Alfred Cove',
                    2 => 'Western Australia',
                    3 => ' 6154',
                    4 => ' ',
                ),
            120 =>
                array (
                    0 => '120',
                    1 => 'Alfredton',
                    2 => 'Victoria',
                    3 => ' 3350',
                    4 => ' ',
                ),
            121 =>
                array (
                    0 => '121',
                    1 => 'Alfredtown',
                    2 => 'New South Wales',
                    3 => ' 2650',
                    4 => ' ',
                ),
            122 =>
                array (
                    0 => '122',
                    1 => 'Algester',
                    2 => 'Queensland',
                    3 => ' 4115',
                    4 => ' ',
                ),
            123 =>
                array (
                    0 => '123',
                    1 => 'Alice',
                    2 => 'New South Wales',
                    3 => ' 2469',
                    4 => ' ',
                ),
            124 =>
                array (
                    0 => '124',
                    1 => 'Alice Creek',
                    2 => 'Queensland',
                    3 => ' 4610',
                    4 => ' ',
                ),
            125 =>
                array (
                    0 => '125',
                    1 => 'Alice River',
                    2 => 'Queensland',
                    3 => ' 4817',
                    4 => ' ',
                ),
            126 =>
                array (
                    0 => '126',
                    1 => 'Alice Springs',
                    2 => 'Northern Territory',
                    3 => ' 870',
                    4 => ' ',
                ),
            127 =>
                array (
                    0 => '127',
                    1 => 'Ali Curung',
                    2 => 'Northern Territory',
                    3 => ' 872',
                    4 => ' ',
                ),
            128 =>
                array (
                    0 => '128',
                    1 => 'Alison',
                    2 => 'New South Wales',
                    3 => ' 2259',
                    4 => ' ',
                ),
            129 =>
                array (
                    0 => '129',
                    1 => 'Alison',
                    2 => 'New South Wales',
                    3 => ' 2420',
                    4 => ' ',
                ),
            130 =>
                array (
                    0 => '130',
                    1 => 'Alkimos',
                    2 => 'Western Australia',
                    3 => ' 6038',
                    4 => ' ',
                ),
            131 =>
                array (
                    0 => '131',
                    1 => 'Allambee',
                    2 => 'Victoria',
                    3 => ' 3823',
                    4 => ' ',
                ),
            132 =>
                array (
                    0 => '132',
                    1 => 'Allambee Reserve',
                    2 => 'Victoria',
                    3 => ' 3871',
                    4 => ' ',
                ),
            133 =>
                array (
                    0 => '133',
                    1 => 'Allambee South',
                    2 => 'Victoria',
                    3 => ' 3871',
                    4 => ' ',
                ),
            134 =>
                array (
                    0 => '134',
                    1 => 'Allambie Heights',
                    2 => 'New South Wales',
                    3 => ' 2100',
                    4 => ' ',
                ),
            135 =>
                array (
                    0 => '135',
                    1 => 'Allan',
                    2 => 'Queensland',
                    3 => ' 4370',
                    4 => ' ',
                ),
            136 =>
                array (
                    0 => '136',
                    1 => 'Allandale',
                    2 => 'New South Wales',
                    3 => ' 2320',
                    4 => ' ',
                ),
            137 =>
                array (
                    0 => '137',
                    1 => 'Allandale',
                    2 => 'Queensland',
                    3 => ' 4310',
                    4 => ' ',
                ),
            138 =>
                array (
                    0 => '138',
                    1 => 'Allanooka',
                    2 => 'Western Australia',
                    3 => ' 6525',
                    4 => ' ',
                ),
            139 =>
                array (
                    0 => '139',
                    1 => 'Allans Flat',
                    2 => 'Victoria',
                    3 => ' 3691',
                    4 => ' ',
                ),
            140 =>
                array (
                    0 => '140',
                    1 => 'Allansford',
                    2 => 'Victoria',
                    3 => ' 3277',
                    4 => ' ',
                ),
            141 =>
                array (
                    0 => '141',
                    1 => 'Allanson',
                    2 => 'Western Australia',
                    3 => ' 6225',
                    4 => ' ',
                ),
            142 =>
                array (
                    0 => '142',
                    1 => 'Allawah',
                    2 => 'New South Wales',
                    3 => ' 2218',
                    4 => ' ',
                ),
            143 =>
                array (
                    0 => '143',
                    1 => 'Alleena',
                    2 => 'New South Wales',
                    3 => ' 2671',
                    4 => ' ',
                ),
            144 =>
                array (
                    0 => '144',
                    1 => 'Allenby Gardens',
                    2 => 'South Australia',
                    3 => ' 5009',
                    4 => ' ',
                ),
            145 =>
                array (
                    0 => '145',
                    1 => 'Allendale',
                    2 => 'Victoria',
                    3 => ' 3364',
                    4 => ' ',
                ),
            146 =>
                array (
                    0 => '146',
                    1 => 'Allendale East',
                    2 => 'South Australia',
                    3 => ' 5291',
                    4 => ' ',
                ),
            147 =>
                array (
                    0 => '147',
                    1 => 'Allendale North',
                    2 => 'South Australia',
                    3 => ' 5373',
                    4 => ' ',
                ),
            148 =>
                array (
                    0 => '148',
                    1 => 'Allens Rivulet',
                    2 => 'Tasmania',
                    3 => ' 7150',
                    4 => ' ',
                ),
            149 =>
                array (
                    0 => '149',
                    1 => 'Allenstown',
                    2 => 'Queensland',
                    3 => ' 4700',
                    4 => ' ',
                ),
            150 =>
                array (
                    0 => '150',
                    1 => 'Allenview',
                    2 => 'Queensland',
                    3 => ' 4285',
                    4 => ' ',
                ),
            151 =>
                array (
                    0 => '151',
                    1 => 'Allestree',
                    2 => 'Victoria',
                    3 => ' 3305',
                    4 => ' ',
                ),
            152 =>
                array (
                    0 => '152',
                    1 => 'Allgomera',
                    2 => 'New South Wales',
                    3 => ' 2441',
                    4 => ' ',
                ),
            153 =>
                array (
                    0 => '153',
                    1 => 'Alligator Creek',
                    2 => 'Queensland',
                    3 => ' 4740',
                    4 => ' ',
                ),
            154 =>
                array (
                    0 => '154',
                    1 => 'Alligator Creek',
                    2 => 'Queensland',
                    3 => ' 4816',
                    4 => ' ',
                ),
            155 =>
                array (
                    0 => '155',
                    1 => 'Allora',
                    2 => 'Queensland',
                    3 => ' 4362',
                    4 => ' ',
                ),
            156 =>
                array (
                    0 => '156',
                    1 => 'Alloway',
                    2 => 'Queensland',
                    3 => ' 4670',
                    4 => ' ',
                ),
            157 =>
                array (
                    0 => '157',
                    1 => 'Allworth',
                    2 => 'New South Wales',
                    3 => ' 2425',
                    4 => ' ',
                ),
            158 =>
                array (
                    0 => '158',
                    1 => 'Allynbrook',
                    2 => 'New South Wales',
                    3 => ' 2311',
                    4 => ' ',
                ),
            159 =>
                array (
                    0 => '159',
                    1 => 'Alma',
                    2 => 'South Australia',
                    3 => ' 5401',
                    4 => ' ',
                ),
            160 =>
                array (
                    0 => '160',
                    1 => 'Alma',
                    2 => 'Victoria',
                    3 => ' 3465',
                    4 => ' ',
                ),
            161 =>
                array (
                    0 => '161',
                    1 => 'Alma',
                    2 => 'Western Australia',
                    3 => ' 6535',
                    4 => ' ',
                ),
            162 =>
                array (
                    0 => '162',
                    1 => 'Almaden',
                    2 => 'Queensland',
                    3 => ' 4871',
                    4 => ' ',
                ),
            163 =>
                array (
                    0 => '163',
                    1 => 'Alma Park',
                    2 => 'New South Wales',
                    3 => ' 2659',
                    4 => ' ',
                ),
            164 =>
                array (
                    0 => '164',
                    1 => 'Almonds',
                    2 => 'Victoria',
                    3 => ' 3727',
                    4 => ' ',
                ),
            165 =>
                array (
                    0 => '165',
                    1 => 'Almurta',
                    2 => 'Victoria',
                    3 => ' 3979',
                    4 => ' ',
                ),
            166 =>
                array (
                    0 => '166',
                    1 => 'Alonnah',
                    2 => 'Tasmania',
                    3 => ' 7150',
                    4 => ' ',
                ),
            167 =>
                array (
                    0 => '167',
                    1 => 'Aloomba',
                    2 => 'Queensland',
                    3 => ' 4871',
                    4 => ' ',
                ),
            168 =>
                array (
                    0 => '168',
                    1 => 'Alpha',
                    2 => 'Queensland',
                    3 => ' 4724',
                    4 => ' ',
                ),
            169 =>
                array (
                    0 => '169',
                    1 => 'Alphington',
                    2 => 'Victoria',
                    3 => ' 3078',
                    4 => ' ',
                ),
            170 =>
                array (
                    0 => '170',
                    1 => 'Alpine',
                    2 => 'New South Wales',
                    3 => ' 2575',
                    4 => ' ',
                ),
            171 =>
                array (
                    0 => '171',
                    1 => 'Alpurrurulam',
                    2 => 'Northern Territory',
                    3 => ' 4825',
                    4 => ' ',
                ),
            172 =>
                array (
                    0 => '172',
                    1 => 'Alsace',
                    2 => 'Queensland',
                    3 => ' 4702',
                    4 => ' ',
                ),
            173 =>
                array (
                    0 => '173',
                    1 => 'Alstonvale',
                    2 => 'New South Wales',
                    3 => ' 2477',
                    4 => ' ',
                ),
            174 =>
                array (
                    0 => '174',
                    1 => 'Alstonville',
                    2 => 'New South Wales',
                    3 => ' 2477',
                    4 => ' ',
                ),
            175 =>
                array (
                    0 => '175',
                    1 => 'Altona',
                    2 => 'South Australia',
                    3 => ' 5351',
                    4 => ' ',
                ),
            176 =>
                array (
                    0 => '176',
                    1 => 'Altona',
                    2 => 'Victoria',
                    3 => ' 3018',
                    4 => ' ',
                ),
            177 =>
                array (
                    0 => '177',
                    1 => 'Altona Meadows',
                    2 => 'Victoria',
                    3 => ' 3028',
                    4 => ' ',
                ),
            178 =>
                array (
                    0 => '178',
                    1 => 'Altona North',
                    2 => 'Victoria',
                    3 => ' 3025',
                    4 => ' ',
                ),
            179 =>
                array (
                    0 => '179',
                    1 => 'Alton Downs',
                    2 => 'Queensland',
                    3 => ' 4702',
                    4 => ' ',
                ),
            180 =>
                array (
                    0 => '180',
                    1 => 'Alumy Creek',
                    2 => 'New South Wales',
                    3 => ' 2460',
                    4 => ' ',
                ),
            181 =>
                array (
                    0 => '181',
                    1 => 'Alva',
                    2 => 'Queensland',
                    3 => ' 4807',
                    4 => ' ',
                ),
            182 =>
                array (
                    0 => '182',
                    1 => 'Alvie',
                    2 => 'Victoria',
                    3 => ' 3249',
                    4 => ' ',
                ),
            183 =>
                array (
                    0 => '183',
                    1 => 'Alyangula',
                    2 => 'Northern Territory',
                    3 => ' 885',
                    4 => ' ',
                ),
            184 =>
                array (
                    0 => '184',
                    1 => 'Amamoor',
                    2 => 'Queensland',
                    3 => ' 4570',
                    4 => ' ',
                ),
            185 =>
                array (
                    0 => '185',
                    1 => 'Amamoor Creek',
                    2 => 'Queensland',
                    3 => ' 4570',
                    4 => ' ',
                ),
            186 =>
                array (
                    0 => '186',
                    1 => 'Amaroo',
                    2 => 'Australian Capital Territory',
                    3 => ' 2914',
                    4 => ' ',
                ),
            187 =>
                array (
                    0 => '187',
                    1 => 'Amaroo',
                    2 => 'New South Wales',
                    3 => ' 2866',
                    4 => ' ',
                ),
            188 =>
                array (
                    0 => '188',
                    1 => 'Amaroo',
                    2 => 'Queensland',
                    3 => ' 4829',
                    4 => ' ',
                ),
            189 =>
                array (
                    0 => '189',
                    1 => 'Amata',
                    2 => 'South Australia',
                    3 => ' 872',
                    4 => ' ',
                ),
            190 =>
                array (
                    0 => '190',
                    1 => 'Ambania',
                    2 => 'Western Australia',
                    3 => ' 6632',
                    4 => ' ',
                ),
            191 =>
                array (
                    0 => '191',
                    1 => 'Ambarvale',
                    2 => 'New South Wales',
                    3 => ' 2560',
                    4 => ' ',
                ),
            192 =>
                array (
                    0 => '192',
                    1 => 'Amber',
                    2 => 'Queensland',
                    3 => ' 4871',
                    4 => ' ',
                ),
            193 =>
                array (
                    0 => '193',
                    1 => 'Ambergate',
                    2 => 'Western Australia',
                    3 => ' 6280',
                    4 => ' ',
                ),
            194 =>
                array (
                    0 => '194',
                    1 => 'Amberley',
                    2 => 'Queensland',
                    3 => ' 4306',
                    4 => ' ',
                ),
            195 =>
                array (
                    0 => '195',
                    1 => 'Ambleside',
                    2 => 'Tasmania',
                    3 => ' 7310',
                    4 => ' ',
                ),
            196 =>
                array (
                    0 => '196',
                    1 => 'Ambrose',
                    2 => 'Queensland',
                    3 => ' 4695',
                    4 => ' ',
                ),
            197 =>
                array (
                    0 => '197',
                    1 => 'Amby',
                    2 => 'Queensland',
                    3 => ' 4462',
                    4 => ' ',
                ),
            198 =>
                array (
                    0 => '198',
                    1 => 'Amelup',
                    2 => 'Western Australia',
                    3 => ' 6338',
                    4 => ' ',
                ),
            199 =>
                array (
                    0 => '199',
                    1 => 'American Beach',
                    2 => 'South Australia',
                    3 => ' 5222',
                    4 => ' ',
                ),
            200 =>
                array (
                    0 => '200',
                    1 => 'American River',
                    2 => 'South Australia',
                    3 => ' 5221',
                    4 => ' ',
                ),
            201 =>
                array (
                    0 => '201',
                    1 => 'Amherst',
                    2 => 'Victoria',
                    3 => ' 3371',
                    4 => ' ',
                ),
            202 =>
                array (
                    0 => '202',
                    1 => 'Amiens',
                    2 => 'Queensland',
                    3 => ' 4380',
                    4 => ' ',
                ),
            203 =>
                array (
                    0 => '203',
                    1 => 'Amity',
                    2 => 'Queensland',
                    3 => ' 4183',
                    4 => ' ',
                ),
            204 =>
                array (
                    0 => '204',
                    1 => 'Amoonguna',
                    2 => 'Northern Territory',
                    3 => ' 873',
                    4 => ' ',
                ),
            205 =>
                array (
                    0 => '205',
                    1 => 'Amor',
                    2 => 'Victoria',
                    3 => ' 3825',
                    4 => ' ',
                ),
            206 =>
                array (
                    0 => '206',
                    1 => 'Amosfield',
                    2 => 'New South Wales',
                    3 => ' 4380',
                    4 => ' ',
                ),
            207 =>
                array (
                    0 => '207',
                    1 => 'Amphitheatre',
                    2 => 'Victoria',
                    3 => ' 3468',
                    4 => ' ',
                ),
            208 =>
                array (
                    0 => '208',
                    1 => 'Ampilatwatja',
                    2 => 'Northern Territory',
                    3 => ' 872',
                    4 => ' ',
                ),
            209 =>
                array (
                    0 => '209',
                    1 => 'Amyton',
                    2 => 'South Australia',
                    3 => ' 5431',
                    4 => ' ',
                ),
            210 =>
                array (
                    0 => '210',
                    1 => 'Anabranch North',
                    2 => 'New South Wales',
                    3 => ' 2648',
                    4 => ' ',
                ),
            211 =>
                array (
                    0 => '211',
                    1 => 'Anabranch South',
                    2 => 'New South Wales',
                    3 => ' 2648',
                    4 => ' ',
                ),
            212 =>
                array (
                    0 => '212',
                    1 => 'Anakie',
                    2 => 'Victoria',
                    3 => ' 3213',
                    4 => ' ',
                ),
            213 =>
                array (
                    0 => '213',
                    1 => 'Anama',
                    2 => 'South Australia',
                    3 => ' 5464',
                    4 => ' ',
                ),
            214 =>
                array (
                    0 => '214',
                    1 => 'Anambah',
                    2 => 'New South Wales',
                    3 => ' 2320',
                    4 => ' ',
                ),
            215 =>
                array (
                    0 => '215',
                    1 => 'Anangu Pitjantjatjara Yankunytjatjara',
                    2 => 'South Australia',
                    3 => ' 872',
                    4 => ' ',
                ),
            216 =>
                array (
                    0 => '216',
                    1 => 'Anatye',
                    2 => 'Northern Territory',
                    3 => ' 872',
                    4 => ' ',
                ),
            217 =>
                array (
                    0 => '217',
                    1 => 'Ancona',
                    2 => 'Victoria',
                    3 => ' 3715',
                    4 => ' ',
                ),
            218 =>
                array (
                    0 => '218',
                    1 => 'Andamooka',
                    2 => 'South Australia',
                    3 => ' 5722',
                    4 => ' ',
                ),
            219 =>
                array (
                    0 => '219',
                    1 => 'Andamooka Station',
                    2 => 'South Australia',
                    3 => ' 5719',
                    4 => ' ',
                ),
            220 =>
                array (
                    0 => '220',
                    1 => 'Andergrove',
                    2 => 'Queensland',
                    3 => ' 4740',
                    4 => ' ',
                ),
            221 =>
                array (
                    0 => '221',
                    1 => 'Anderleigh',
                    2 => 'Queensland',
                    3 => ' 4570',
                    4 => ' ',
                ),
            222 =>
                array (
                    0 => '222',
                    1 => 'Anderson',
                    2 => 'Victoria',
                    3 => ' 3995',
                    4 => ' ',
                ),
            223 =>
                array (
                    0 => '223',
                    1 => 'Ando',
                    2 => 'New South Wales',
                    3 => ' 2631',
                    4 => ' ',
                ),
            224 =>
                array (
                    0 => '224',
                    1 => 'Andover',
                    2 => 'Tasmania',
                    3 => ' 7120',
                    4 => ' ',
                ),
            225 =>
                array (
                    0 => '225',
                    1 => 'Andrews',
                    2 => 'South Australia',
                    3 => ' 5454',
                    4 => ' ',
                ),
            226 =>
                array (
                    0 => '226',
                    1 => 'Andrews Farm',
                    2 => 'South Australia',
                    3 => ' 5114',
                    4 => ' ',
                ),
            227 =>
                array (
                    0 => '227',
                    1 => 'Andromache',
                    2 => 'Queensland',
                    3 => ' 4800',
                    4 => ' ',
                ),
            228 =>
                array (
                    0 => '228',
                    1 => 'Anduramba',
                    2 => 'Queensland',
                    3 => ' 4355',
                    4 => ' ',
                ),
            229 =>
                array (
                    0 => '229',
                    1 => 'Anembo',
                    2 => 'New South Wales',
                    3 => ' 2621',
                    4 => ' ',
                ),
            230 =>
                array (
                    0 => '230',
                    1 => 'Angas Plains',
                    2 => 'South Australia',
                    3 => ' 5255',
                    4 => ' ',
                ),
            231 =>
                array (
                    0 => '231',
                    1 => 'Angaston',
                    2 => 'South Australia',
                    3 => ' 5353',
                    4 => ' ',
                ),
            232 =>
                array (
                    0 => '232',
                    1 => 'Angas Valley',
                    2 => 'South Australia',
                    3 => ' 5238',
                    4 => ' ',
                ),
            233 =>
                array (
                    0 => '233',
                    1 => 'Angelo River',
                    2 => 'Western Australia',
                    3 => ' 6642',
                    4 => ' ',
                ),
            234 =>
                array (
                    0 => '234',
                    1 => 'Angledale',
                    2 => 'New South Wales',
                    3 => ' 2550',
                    4 => ' ',
                ),
            235 =>
                array (
                    0 => '235',
                    1 => 'Angledool',
                    2 => 'New South Wales',
                    3 => ' 2834',
                    4 => ' ',
                ),
            236 =>
                array (
                    0 => '236',
                    1 => 'Angle Park',
                    2 => 'South Australia',
                    3 => ' 5010',
                    4 => ' ',
                ),
            237 =>
                array (
                    0 => '237',
                    1 => 'Anglers Reach',
                    2 => 'New South Wales',
                    3 => ' 2629',
                    4 => ' ',
                ),
            238 =>
                array (
                    0 => '238',
                    1 => 'Anglers Rest',
                    2 => 'Victoria',
                    3 => ' 3898',
                    4 => ' ',
                ),
            239 =>
                array (
                    0 => '239',
                    1 => 'Anglesea',
                    2 => 'Victoria',
                    3 => ' 3230',
                    4 => ' ',
                ),
            240 =>
                array (
                    0 => '240',
                    1 => 'Angle Vale',
                    2 => 'South Australia',
                    3 => ' 5117',
                    4 => ' ',
                ),
            241 =>
                array (
                    0 => '241',
                    1 => 'Angourie',
                    2 => 'New South Wales',
                    3 => ' 2464',
                    4 => ' ',
                ),
            242 =>
                array (
                    0 => '242',
                    1 => 'Angurugu',
                    2 => 'Northern Territory',
                    3 => ' 822',
                    4 => ' ',
                ),
            243 =>
                array (
                    0 => '243',
                    1 => 'Anindilyakwa',
                    2 => 'Northern Territory',
                    3 => ' 822',
                    4 => ' ',
                ),
            244 =>
                array (
                    0 => '244',
                    1 => 'Anketell',
                    2 => 'Western Australia',
                    3 => ' 6167',
                    4 => ' ',
                ),
            245 =>
                array (
                    0 => '245',
                    1 => 'Anmatjere',
                    2 => 'Northern Territory',
                    3 => ' 872',
                    4 => ' ',
                ),
            246 =>
                array (
                    0 => '246',
                    1 => 'Anna Bay',
                    2 => 'New South Wales',
                    3 => ' 2316',
                    4 => ' ',
                ),
            247 =>
                array (
                    0 => '247',
                    1 => 'Annadale',
                    2 => 'South Australia',
                    3 => ' 5356',
                    4 => ' ',
                ),
            248 =>
                array (
                    0 => '248',
                    1 => 'Annandale',
                    2 => 'New South Wales',
                    3 => ' 2038',
                    4 => ' ',
                ),
            249 =>
                array (
                    0 => '249',
                    1 => 'Annandale',
                    2 => 'Queensland',
                    3 => ' 4814',
                    4 => ' ',
                ),
            250 =>
                array (
                    0 => '250',
                    1 => 'Annangrove',
                    2 => 'New South Wales',
                    3 => ' 2156',
                    4 => ' ',
                ),
            251 =>
                array (
                    0 => '251',
                    1 => 'Annerley',
                    2 => 'Queensland',
                    3 => ' 4103',
                    4 => ' ',
                ),
            252 =>
                array (
                    0 => '252',
                    1 => 'Anniebrook',
                    2 => 'Western Australia',
                    3 => ' 6280',
                    4 => ' ',
                ),
            253 =>
                array (
                    0 => '253',
                    1 => 'Annuello',
                    2 => 'Victoria',
                    3 => ' 3549',
                    4 => ' ',
                ),
            254 =>
                array (
                    0 => '254',
                    1 => 'Ansons Bay',
                    2 => 'Tasmania',
                    3 => ' 7264',
                    4 => ' ',
                ),
            255 =>
                array (
                    0 => '255',
                    1 => 'Anstead',
                    2 => 'Queensland',
                    3 => ' 4070',
                    4 => ' ',
                ),
            256 =>
                array (
                    0 => '256',
                    1 => 'Antechamber Bay',
                    2 => 'South Australia',
                    3 => ' 5222',
                    4 => ' ',
                ),
            257 =>
                array (
                    0 => '257',
                    1 => 'Anthony',
                    2 => 'Queensland',
                    3 => ' 4310',
                    4 => ' ',
                ),
            258 =>
                array (
                    0 => '258',
                    1 => 'Antigua',
                    2 => 'Queensland',
                    3 => ' 4650',
                    4 => ' ',
                ),
            259 =>
                array (
                    0 => '259',
                    1 => 'Antill Ponds',
                    2 => 'Tasmania',
                    3 => ' 7120',
                    4 => ' ',
                ),
            260 =>
                array (
                    0 => '260',
                    1 => 'Antonymyre',
                    2 => 'Western Australia',
                    3 => ' 6714',
                    4 => ' ',
                ),
            261 =>
                array (
                    0 => '261',
                    1 => 'Antwerp',
                    2 => 'Victoria',
                    3 => ' 3414',
                    4 => ' ',
                ),
            262 =>
                array (
                    0 => '262',
                    1 => 'Anula',
                    2 => 'Northern Territory',
                    3 => ' 812',
                    4 => ' ',
                ),
            263 =>
                array (
                    0 => '263',
                    1 => 'Apamurra',
                    2 => 'South Australia',
                    3 => ' 5237',
                    4 => ' ',
                ),
            264 =>
                array (
                    0 => '264',
                    1 => 'Apoinga',
                    2 => 'South Australia',
                    3 => ' 5413',
                    4 => ' ',
                ),
            265 =>
                array (
                    0 => '265',
                    1 => 'Apollo Bay',
                    2 => 'Tasmania',
                    3 => ' 7150',
                    4 => ' ',
                ),
            266 =>
                array (
                    0 => '266',
                    1 => 'Apollo Bay',
                    2 => 'Victoria',
                    3 => ' 3233',
                    4 => ' ',
                ),
            267 =>
                array (
                    0 => '267',
                    1 => 'Appila',
                    2 => 'South Australia',
                    3 => ' 5480',
                    4 => ' ',
                ),
            268 =>
                array (
                    0 => '268',
                    1 => 'Appin',
                    2 => 'New South Wales',
                    3 => ' 2560',
                    4 => ' ',
                ),
            269 =>
                array (
                    0 => '269',
                    1 => 'Appin',
                    2 => 'Victoria',
                    3 => ' 3579',
                    4 => ' ',
                ),
            270 =>
                array (
                    0 => '270',
                    1 => 'Appin South',
                    2 => 'Victoria',
                    3 => ' 3579',
                    4 => ' ',
                ),
            271 =>
                array (
                    0 => '271',
                    1 => 'Appleby',
                    2 => 'New South Wales',
                    3 => ' 2340',
                    4 => ' ',
                ),
            272 =>
                array (
                    0 => '272',
                    1 => 'Applecross',
                    2 => 'Western Australia',
                    3 => ' 6153',
                    4 => ' ',
                ),
            273 =>
                array (
                    0 => '273',
                    1 => 'Applethorpe',
                    2 => 'Queensland',
                    3 => ' 4378',
                    4 => ' ',
                ),
            274 =>
                array (
                    0 => '274',
                    1 => 'Apple Tree Creek',
                    2 => 'Queensland',
                    3 => ' 4660',
                    4 => ' ',
                ),
            275 =>
                array (
                    0 => '275',
                    1 => 'Appletree Flat',
                    2 => 'New South Wales',
                    3 => ' 2330',
                    4 => ' ',
                ),
            276 =>
                array (
                    0 => '276',
                    1 => 'Apple Tree Flat',
                    2 => 'New South Wales',
                    3 => ' 2850',
                    4 => ' ',
                ),
            277 =>
                array (
                    0 => '277',
                    1 => 'Apslawn',
                    2 => 'Tasmania',
                    3 => ' 7190',
                    4 => ' ',
                ),
            278 =>
                array (
                    0 => '278',
                    1 => 'Apsley',
                    2 => 'New South Wales',
                    3 => ' 2820',
                    4 => ' ',
                ),
            279 =>
                array (
                    0 => '279',
                    1 => 'Apsley',
                    2 => 'Tasmania',
                    3 => ' 7030',
                    4 => ' ',
                ),
            280 =>
                array (
                    0 => '280',
                    1 => 'Apsley',
                    2 => 'Victoria',
                    3 => ' 3319',
                    4 => ' ',
                ),
            281 =>
                array (
                    0 => '281',
                    1 => 'Arable',
                    2 => 'New South Wales',
                    3 => ' 2630',
                    4 => ' ',
                ),
            282 =>
                array (
                    0 => '282',
                    1 => 'Arakoon',
                    2 => 'New South Wales',
                    3 => ' 2431',
                    4 => ' ',
                ),
            283 =>
                array (
                    0 => '283',
                    1 => 'Araluen',
                    2 => 'New South Wales',
                    3 => ' 2622',
                    4 => ' ',
                ),
            284 =>
                array (
                    0 => '284',
                    1 => 'Araluen',
                    2 => 'Northern Territory',
                    3 => ' 870',
                    4 => ' ',
                ),
            285 =>
                array (
                    0 => '285',
                    1 => 'Araluen',
                    2 => 'Queensland',
                    3 => ' 4570',
                    4 => ' ',
                ),
            286 =>
                array (
                    0 => '286',
                    1 => 'Aramac',
                    2 => 'Queensland',
                    3 => ' 4726',
                    4 => ' ',
                ),
            287 =>
                array (
                    0 => '287',
                    1 => 'Aramara',
                    2 => 'Queensland',
                    3 => ' 4620',
                    4 => ' ',
                ),
            288 =>
                array (
                    0 => '288',
                    1 => 'Arana Hills',
                    2 => 'Queensland',
                    3 => ' 4054',
                    4 => ' ',
                ),
            289 =>
                array (
                    0 => '289',
                    1 => 'Aranbanga',
                    2 => 'Queensland',
                    3 => ' 4625',
                    4 => ' ',
                ),
            290 =>
                array (
                    0 => '290',
                    1 => 'Aranda',
                    2 => 'Australian Capital Territory',
                    3 => ' 2614',
                    4 => ' ',
                ),
            291 =>
                array (
                    0 => '291',
                    1 => 'Ararat',
                    2 => 'Victoria',
                    3 => ' 3377',
                    4 => ' ',
                ),
            292 =>
                array (
                    0 => '292',
                    1 => 'Aratula',
                    2 => 'New South Wales',
                    3 => ' 2714',
                    4 => ' ',
                ),
            293 =>
                array (
                    0 => '293',
                    1 => 'Aratula',
                    2 => 'Queensland',
                    3 => ' 4309',
                    4 => ' ',
                ),
            294 =>
                array (
                    0 => '294',
                    1 => 'Arawata',
                    2 => 'Victoria',
                    3 => ' 3951',
                    4 => ' ',
                ),
            295 =>
                array (
                    0 => '295',
                    1 => 'Arbouin',
                    2 => 'Queensland',
                    3 => ' 4892',
                    4 => ' ',
                ),
            296 =>
                array (
                    0 => '296',
                    1 => 'Arbuckle',
                    2 => 'Victoria',
                    3 => ' 3858',
                    4 => ' ',
                ),
            297 =>
                array (
                    0 => '297',
                    1 => 'Arcadia',
                    2 => 'New South Wales',
                    3 => ' 2159',
                    4 => ' ',
                ),
            298 =>
                array (
                    0 => '298',
                    1 => 'Arcadia',
                    2 => 'Queensland',
                    3 => ' 4819',
                    4 => ' ',
                ),
            299 =>
                array (
                    0 => '299',
                    1 => 'Arcadia',
                    2 => 'Victoria',
                    3 => ' 3631',
                    4 => ' ',
                ),
            300 =>
                array (
                    0 => '300',
                    1 => 'Arcadia South',
                    2 => 'Victoria',
                    3 => ' 3631',
                    4 => ' ',
                ),
            301 =>
                array (
                    0 => '301',
                    1 => 'Arcadia Vale',
                    2 => 'New South Wales',
                    3 => ' 2283',
                    4 => ' ',
                ),
            302 =>
                array (
                    0 => '302',
                    1 => 'Arcadia Valley',
                    2 => 'Queensland',
                    3 => ' 4702',
                    4 => ' ',
                ),
            303 =>
                array (
                    0 => '303',
                    1 => 'Archdale',
                    2 => 'Victoria',
                    3 => ' 3475',
                    4 => ' ',
                ),
            304 =>
                array (
                    0 => '304',
                    1 => 'Archdale Junction',
                    2 => 'Victoria',
                    3 => ' 3475',
                    4 => ' ',
                ),
            305 =>
                array (
                    0 => '305',
                    1 => 'Archer',
                    2 => 'Northern Territory',
                    3 => ' 830',
                    4 => ' ',
                ),
            306 =>
                array (
                    0 => '306',
                    1 => 'Archerfield',
                    2 => 'Queensland',
                    3 => ' 4108',
                    4 => ' ',
                ),
            307 =>
                array (
                    0 => '307',
                    1 => 'Archer River',
                    2 => 'Queensland',
                    3 => ' 4892',
                    4 => ' ',
                ),
            308 =>
                array (
                    0 => '308',
                    1 => 'Archerton',
                    2 => 'Victoria',
                    3 => ' 3723',
                    4 => ' ',
                ),
            309 =>
                array (
                    0 => '309',
                    1 => 'Archies Creek',
                    2 => 'Victoria',
                    3 => ' 3995',
                    4 => ' ',
                ),
            310 =>
                array (
                    0 => '310',
                    1 => 'Arcoona',
                    2 => 'South Australia',
                    3 => ' 5720',
                    4 => ' ',
                ),
            311 =>
                array (
                    0 => '311',
                    1 => 'Arcturus',
                    2 => 'Queensland',
                    3 => ' 4722',
                    4 => ' ',
                ),
            312 =>
                array (
                    0 => '312',
                    1 => 'Ardath',
                    2 => 'Western Australia',
                    3 => ' 6419',
                    4 => ' ',
                ),
            313 =>
                array (
                    0 => '313',
                    1 => 'Ardeer',
                    2 => 'Victoria',
                    3 => ' 3022',
                    4 => ' ',
                ),
            314 =>
                array (
                    0 => '314',
                    1 => 'Ardglen',
                    2 => 'New South Wales',
                    3 => ' 2338',
                    4 => ' ',
                ),
            315 =>
                array (
                    0 => '315',
                    1 => 'Arding',
                    2 => 'New South Wales',
                    3 => ' 2358',
                    4 => ' ',
                ),
            316 =>
                array (
                    0 => '316',
                    1 => 'Ardlethan',
                    2 => 'New South Wales',
                    3 => ' 2665',
                    4 => ' ',
                ),
            317 =>
                array (
                    0 => '317',
                    1 => 'Ardmona',
                    2 => 'Victoria',
                    3 => ' 3629',
                    4 => ' ',
                ),
            318 =>
                array (
                    0 => '318',
                    1 => 'Ardross',
                    2 => 'Western Australia',
                    3 => ' 6153',
                    4 => ' ',
                ),
            319 =>
                array (
                    0 => '319',
                    1 => 'Ardrossan',
                    2 => 'South Australia',
                    3 => ' 5571',
                    4 => ' ',
                ),
            320 =>
                array (
                    0 => '320',
                    1 => 'Areegra',
                    2 => 'Victoria',
                    3 => ' 3480',
                    4 => ' ',
                ),
            321 =>
                array (
                    0 => '321',
                    1 => 'Areyonga',
                    2 => 'Northern Territory',
                    3 => ' 872',
                    4 => ' ',
                ),
            322 =>
                array (
                    0 => '322',
                    1 => 'Argalong',
                    2 => 'New South Wales',
                    3 => ' 2720',
                    4 => ' ',
                ),
            323 =>
                array (
                    0 => '323',
                    1 => 'Argenton',
                    2 => 'New South Wales',
                    3 => ' 2284',
                    4 => ' ',
                ),
            324 =>
                array (
                    0 => '324',
                    1 => 'Argents Hill',
                    2 => 'New South Wales',
                    3 => ' 2449',
                    4 => ' ',
                ),
            325 =>
                array (
                    0 => '325',
                    1 => 'Argoon',
                    2 => 'New South Wales',
                    3 => ' 2707',
                    4 => ' ',
                ),
            326 =>
                array (
                    0 => '326',
                    1 => 'Argoon',
                    2 => 'Queensland',
                    3 => ' 4702',
                    4 => ' ',
                ),
            327 =>
                array (
                    0 => '327',
                    1 => 'Argyle',
                    2 => 'Victoria',
                    3 => ' 3523',
                    4 => ' ',
                ),
            328 =>
                array (
                    0 => '328',
                    1 => 'Argyle',
                    2 => 'Western Australia',
                    3 => ' 6239',
                    4 => ' ',
                ),
            329 =>
                array (
                    0 => '329',
                    1 => 'Argyll',
                    2 => 'Queensland',
                    3 => ' 4721',
                    4 => ' ',
                ),
            330 =>
                array (
                    0 => '330',
                    1 => 'Ariah Park',
                    2 => 'New South Wales',
                    3 => ' 2665',
                    4 => ' ',
                ),
            331 =>
                array (
                    0 => '331',
                    1 => 'Arkaroola Village',
                    2 => 'South Australia',
                    3 => ' 5732',
                    4 => ' ',
                ),
            332 =>
                array (
                    0 => '332',
                    1 => 'Arkell',
                    2 => 'New South Wales',
                    3 => ' 2795',
                    4 => ' ',
                ),
            333 =>
                array (
                    0 => '333',
                    1 => 'Arkstone',
                    2 => 'New South Wales',
                    3 => ' 2795',
                    4 => ' ',
                ),
            334 =>
                array (
                    0 => '334',
                    1 => 'Armadale',
                    2 => 'Victoria',
                    3 => ' 3143',
                    4 => ' ',
                ),
            335 =>
                array (
                    0 => '335',
                    1 => 'Armadale',
                    2 => 'Western Australia',
                    3 => ' 6112',
                    4 => ' ',
                ),
            336 =>
                array (
                    0 => '336',
                    1 => 'Armagh',
                    2 => 'South Australia',
                    3 => ' 5453',
                    4 => ' ',
                ),
            337 =>
                array (
                    0 => '337',
                    1 => 'Armatree',
                    2 => 'New South Wales',
                    3 => ' 2828',
                    4 => ' ',
                ),
            338 =>
                array (
                    0 => '338',
                    1 => 'Armidale',
                    2 => 'New South Wales',
                    3 => ' 2350',
                    4 => ' ',
                ),
            339 =>
                array (
                    0 => '339',
                    1 => 'Armstrong',
                    2 => 'Victoria',
                    3 => ' 3377',
                    4 => ' ',
                ),
            340 =>
                array (
                    0 => '340',
                    1 => 'Armstrong Beach',
                    2 => 'Queensland',
                    3 => ' 4737',
                    4 => ' ',
                ),
            341 =>
                array (
                    0 => '341',
                    1 => 'Armstrong Creek',
                    2 => 'Queensland',
                    3 => ' 4520',
                    4 => ' ',
                ),
            342 =>
                array (
                    0 => '342',
                    1 => 'Armstrong Creek',
                    2 => 'Victoria',
                    3 => ' 3217',
                    4 => ' ',
                ),
            343 =>
                array (
                    0 => '343',
                    1 => 'Arncliffe',
                    2 => 'New South Wales',
                    3 => ' 2205',
                    4 => ' ',
                ),
            344 =>
                array (
                    0 => '344',
                    1 => 'Arndell Park',
                    2 => 'New South Wales',
                    3 => ' 2148',
                    4 => ' ',
                ),
            345 =>
                array (
                    0 => '345',
                    1 => 'Arno Bay',
                    2 => 'South Australia',
                    3 => ' 5603',
                    4 => ' ',
                ),
            346 =>
                array (
                    0 => '346',
                    1 => 'Arnold',
                    2 => 'Northern Territory',
                    3 => ' 852',
                    4 => ' ',
                ),
            347 =>
                array (
                    0 => '347',
                    1 => 'Arnold',
                    2 => 'Victoria',
                    3 => ' 3551',
                    4 => ' ',
                ),
            348 =>
                array (
                    0 => '348',
                    1 => 'Arnold West',
                    2 => 'Victoria',
                    3 => ' 3551',
                    4 => ' ',
                ),
            349 =>
                array (
                    0 => '349',
                    1 => 'Aroona',
                    2 => 'Queensland',
                    3 => ' 4551',
                    4 => ' ',
                ),
            350 =>
                array (
                    0 => '350',
                    1 => 'Arrawarra',
                    2 => 'New South Wales',
                    3 => ' 2456',
                    4 => ' ',
                ),
            351 =>
                array (
                    0 => '351',
                    1 => 'Arrawarra Headland',
                    2 => 'New South Wales',
                    3 => ' 2456',
                    4 => ' ',
                ),
            352 =>
                array (
                    0 => '352',
                    1 => 'Arriga',
                    2 => 'Queensland',
                    3 => ' 4880',
                    4 => ' ',
                ),
            353 =>
                array (
                    0 => '353',
                    1 => 'Arrino',
                    2 => 'Western Australia',
                    3 => ' 6519',
                    4 => ' ',
                ),
            354 =>
                array (
                    0 => '354',
                    1 => 'Arrowsmith',
                    2 => 'Western Australia',
                    3 => ' 6525',
                    4 => ' ',
                ),
            355 =>
                array (
                    0 => '355',
                    1 => 'Arrowsmith East',
                    2 => 'Western Australia',
                    3 => ' 6519',
                    4 => ' ',
                ),
            356 =>
                array (
                    0 => '356',
                    1 => 'Artarmon',
                    2 => 'New South Wales',
                    3 => ' 2064',
                    4 => ' ',
                ),
            357 =>
                array (
                    0 => '357',
                    1 => 'Arthur River',
                    2 => 'Tasmania',
                    3 => ' 7330',
                    4 => ' ',
                ),
            358 =>
                array (
                    0 => '358',
                    1 => 'Arthur River',
                    2 => 'Western Australia',
                    3 => ' 6315',
                    4 => ' ',
                ),
            359 =>
                array (
                    0 => '359',
                    1 => 'Arthurs Creek',
                    2 => 'Victoria',
                    3 => ' 3099',
                    4 => ' ',
                ),
            360 =>
                array (
                    0 => '360',
                    1 => 'Arthurs Lake',
                    2 => 'Tasmania',
                    3 => ' 7030',
                    4 => ' ',
                ),
            361 =>
                array (
                    0 => '361',
                    1 => 'Arthurs Seat',
                    2 => 'Victoria',
                    3 => ' 3936',
                    4 => ' ',
                ),
            362 =>
                array (
                    0 => '362',
                    1 => 'Arthurton',
                    2 => 'South Australia',
                    3 => ' 5572',
                    4 => ' ',
                ),
            363 =>
                array (
                    0 => '363',
                    1 => 'Arthurville',
                    2 => 'New South Wales',
                    3 => ' 2820',
                    4 => ' ',
                ),
            364 =>
                array (
                    0 => '364',
                    1 => 'Arumbera',
                    2 => 'Northern Territory',
                    3 => ' 873',
                    4 => ' ',
                ),
            365 =>
                array (
                    0 => '365',
                    1 => 'Arumpo',
                    2 => 'New South Wales',
                    3 => ' 2715',
                    4 => ' ',
                ),
            366 =>
                array (
                    0 => '366',
                    1 => 'Arundel',
                    2 => 'Queensland',
                    3 => ' 4214',
                    4 => ' ',
                ),
            367 =>
                array (
                    0 => '367',
                    1 => 'Ascot',
                    2 => 'Queensland',
                    3 => ' 4007',
                    4 => ' ',
                ),
            368 =>
                array (
                    0 => '368',
                    1 => 'Ascot',
                    2 => 'Queensland',
                    3 => ' 4360',
                    4 => ' ',
                ),
            369 =>
                array (
                    0 => '369',
                    1 => 'Ascot',
                    2 => 'Victoria',
                    3 => ' 3364',
                    4 => ' ',
                ),
            370 =>
                array (
                    0 => '370',
                    1 => 'Ascot',
                    2 => 'Victoria',
                    3 => ' 3551',
                    4 => ' ',
                ),
            371 =>
                array (
                    0 => '371',
                    1 => 'Ascot',
                    2 => 'Western Australia',
                    3 => ' 6104',
                    4 => ' ',
                ),
            372 =>
                array (
                    0 => '372',
                    1 => 'Ascot Park',
                    2 => 'South Australia',
                    3 => ' 5043',
                    4 => ' ',
                ),
            373 =>
                array (
                    0 => '373',
                    1 => 'Ascot Vale',
                    2 => 'Victoria',
                    3 => ' 3032',
                    4 => ' ',
                ),
            374 =>
                array (
                    0 => '374',
                    1 => 'Ashbourne',
                    2 => 'South Australia',
                    3 => ' 5157',
                    4 => ' ',
                ),
            375 =>
                array (
                    0 => '375',
                    1 => 'Ashbourne',
                    2 => 'Victoria',
                    3 => ' 3442',
                    4 => ' ',
                ),
            376 =>
                array (
                    0 => '376',
                    1 => 'Ashburton',
                    2 => 'Victoria',
                    3 => ' 3147',
                    4 => ' ',
                ),
            377 =>
                array (
                    0 => '377',
                    1 => 'Ashbury',
                    2 => 'New South Wales',
                    3 => ' 2193',
                    4 => ' ',
                ),
            378 =>
                array (
                    0 => '378',
                    1 => 'Ashby',
                    2 => 'New South Wales',
                    3 => ' 2463',
                    4 => ' ',
                ),
            379 =>
                array (
                    0 => '379',
                    1 => 'Ashby',
                    2 => 'Western Australia',
                    3 => ' 6065',
                    4 => ' ',
                ),
            380 =>
                array (
                    0 => '380',
                    1 => 'Ashby Heights',
                    2 => 'New South Wales',
                    3 => ' 2463',
                    4 => ' ',
                ),
            381 =>
                array (
                    0 => '381',
                    1 => 'Ashby Island',
                    2 => 'New South Wales',
                    3 => ' 2463',
                    4 => ' ',
                ),
            382 =>
                array (
                    0 => '382',
                    1 => 'Ashcroft',
                    2 => 'New South Wales',
                    3 => ' 2168',
                    4 => ' ',
                ),
            383 =>
                array (
                    0 => '383',
                    1 => 'Ashendon',
                    2 => 'Western Australia',
                    3 => ' 6111',
                    4 => ' ',
                ),
            384 =>
                array (
                    0 => '384',
                    1 => 'Ashfield',
                    2 => 'New South Wales',
                    3 => ' 2131',
                    4 => ' ',
                ),
            385 =>
                array (
                    0 => '385',
                    1 => 'Ashfield',
                    2 => 'Queensland',
                    3 => ' 4670',
                    4 => ' ',
                ),
            386 =>
                array (
                    0 => '386',
                    1 => 'Ashfield',
                    2 => 'Western Australia',
                    3 => ' 6054',
                    4 => ' ',
                ),
            387 =>
                array (
                    0 => '387',
                    1 => 'Ashford',
                    2 => 'New South Wales',
                    3 => ' 2361',
                    4 => ' ',
                ),
            388 =>
                array (
                    0 => '388',
                    1 => 'Ashford',
                    2 => 'South Australia',
                    3 => ' 5035',
                    4 => ' ',
                ),
            389 =>
                array (
                    0 => '389',
                    1 => 'Ashgrove',
                    2 => 'Queensland',
                    3 => ' 4060',
                    4 => ' ',
                ),
            390 =>
                array (
                    0 => '390',
                    1 => 'Ashley',
                    2 => 'New South Wales',
                    3 => ' 2400',
                    4 => ' ',
                ),
            391 =>
                array (
                    0 => '391',
                    1 => 'Ashmont',
                    2 => 'New South Wales',
                    3 => ' 2650',
                    4 => ' ',
                ),
            392 =>
                array (
                    0 => '392',
                    1 => 'Ashmore',
                    2 => 'Queensland',
                    3 => ' 4214',
                    4 => ' ',
                ),
            393 =>
                array (
                    0 => '393',
                    1 => 'Ashton',
                    2 => 'South Australia',
                    3 => ' 5137',
                    4 => ' ',
                ),
            394 =>
                array (
                    0 => '394',
                    1 => 'Ashtonfield',
                    2 => 'New South Wales',
                    3 => ' 2323',
                    4 => ' ',
                ),
            395 =>
                array (
                    0 => '395',
                    1 => 'Ashville',
                    2 => 'South Australia',
                    3 => ' 5259',
                    4 => ' ',
                ),
            396 =>
                array (
                    0 => '396',
                    1 => 'Ashwell',
                    2 => 'Queensland',
                    3 => ' 4340',
                    4 => ' ',
                ),
            397 =>
                array (
                    0 => '397',
                    1 => 'Ashwood',
                    2 => 'Victoria',
                    3 => ' 3147',
                    4 => ' ',
                ),
            398 =>
                array (
                    0 => '398',
                    1 => 'Aspendale',
                    2 => 'Victoria',
                    3 => ' 3195',
                    4 => ' ',
                ),
            399 =>
                array (
                    0 => '399',
                    1 => 'Aspendale Gardens',
                    2 => 'Victoria',
                    3 => ' 3195',
                    4 => ' ',
                ),
            400 =>
                array (
                    0 => '400',
                    1 => 'Aspley',
                    2 => 'Queensland',
                    3 => ' 4034',
                    4 => ' ',
                ),
            401 =>
                array (
                    0 => '401',
                    1 => 'Asquith',
                    2 => 'New South Wales',
                    3 => ' 2077',
                    4 => ' ',
                ),
            402 =>
                array (
                    0 => '402',
                    1 => 'Athelstone',
                    2 => 'South Australia',
                    3 => ' 5076',
                    4 => ' ',
                ),
            403 =>
                array (
                    0 => '403',
                    1 => 'Atherton',
                    2 => 'Queensland',
                    3 => ' 4883',
                    4 => ' ',
                ),
            404 =>
                array (
                    0 => '404',
                    1 => 'Athlone',
                    2 => 'Victoria',
                    3 => ' 3818',
                    4 => ' ',
                ),
            405 =>
                array (
                    0 => '405',
                    1 => 'Athol',
                    2 => 'Queensland',
                    3 => ' 4350',
                    4 => ' ',
                ),
            406 =>
                array (
                    0 => '406',
                    1 => 'Athol Park',
                    2 => 'South Australia',
                    3 => ' 5012',
                    4 => ' ',
                ),
            407 =>
                array (
                    0 => '407',
                    1 => 'Atholwood',
                    2 => 'New South Wales',
                    3 => ' 2361',
                    4 => ' ',
                ),
            408 =>
                array (
                    0 => '408',
                    1 => 'Atitjere',
                    2 => 'Northern Territory',
                    3 => ' 872',
                    4 => ' ',
                ),
            409 =>
                array (
                    0 => '409',
                    1 => 'Atkinsons Dam',
                    2 => 'Queensland',
                    3 => ' 4311',
                    4 => ' ',
                ),
            410 =>
                array (
                    0 => '410',
                    1 => 'Attadale',
                    2 => 'Western Australia',
                    3 => ' 6156',
                    4 => ' ',
                ),
            411 =>
                array (
                    0 => '411',
                    1 => 'Attunga',
                    2 => 'New South Wales',
                    3 => ' 2345',
                    4 => ' ',
                ),
            412 =>
                array (
                    0 => '412',
                    1 => 'Attwood',
                    2 => 'Victoria',
                    3 => ' 3049',
                    4 => ' ',
                ),
            413 =>
                array (
                    0 => '413',
                    1 => 'Atwell',
                    2 => 'Western Australia',
                    3 => ' 6164',
                    4 => ' ',
                ),
            414 =>
                array (
                    0 => '414',
                    1 => 'Aubigny',
                    2 => 'Queensland',
                    3 => ' 4401',
                    4 => ' ',
                ),
            415 =>
                array (
                    0 => '415',
                    1 => 'Aubin Grove',
                    2 => 'Western Australia',
                    3 => ' 6164',
                    4 => ' ',
                ),
            416 =>
                array (
                    0 => '416',
                    1 => 'Aubrey',
                    2 => 'Victoria',
                    3 => ' 3393',
                    4 => ' ',
                ),
            417 =>
                array (
                    0 => '417',
                    1 => 'Auburn',
                    2 => 'New South Wales',
                    3 => ' 2144',
                    4 => ' ',
                ),
            418 =>
                array (
                    0 => '418',
                    1 => 'Auburn',
                    2 => 'Queensland',
                    3 => ' 4413',
                    4 => ' ',
                ),
            419 =>
                array (
                    0 => '419',
                    1 => 'Auburn',
                    2 => 'South Australia',
                    3 => ' 5451',
                    4 => ' ',
                ),
            420 =>
                array (
                    0 => '420',
                    1 => 'Auburn Vale',
                    2 => 'New South Wales',
                    3 => ' 2360',
                    4 => ' ',
                ),
            421 =>
                array (
                    0 => '421',
                    1 => 'Auchenflower',
                    2 => 'Queensland',
                    3 => ' 4066',
                    4 => ' ',
                ),
            422 =>
                array (
                    0 => '422',
                    1 => 'Auchmore',
                    2 => 'Victoria',
                    3 => ' 3570',
                    4 => ' ',
                ),
            423 =>
                array (
                    0 => '423',
                    1 => 'Augathella',
                    2 => 'Queensland',
                    3 => ' 4477',
                    4 => ' ',
                ),
            424 =>
                array (
                    0 => '424',
                    1 => 'Augusta',
                    2 => 'Western Australia',
                    3 => ' 6290',
                    4 => ' ',
                ),
            425 =>
                array (
                    0 => '425',
                    1 => 'Augustine Heights',
                    2 => 'Queensland',
                    3 => ' 4300',
                    4 => ' ',
                ),
            426 =>
                array (
                    0 => '426',
                    1 => 'Auldana',
                    2 => 'South Australia',
                    3 => ' 5072',
                    4 => ' ',
                ),
            427 =>
                array (
                    0 => '427',
                    1 => 'Aurukun',
                    2 => 'Queensland',
                    3 => ' 4892',
                    4 => ' ',
                ),
            428 =>
                array (
                    0 => '428',
                    1 => 'Austinmer',
                    2 => 'New South Wales',
                    3 => ' 2515',
                    4 => ' ',
                ),
            429 =>
                array (
                    0 => '429',
                    1 => 'Austins Ferry',
                    2 => 'Tasmania',
                    3 => ' 7011',
                    4 => ' ',
                ),
            430 =>
                array (
                    0 => '430',
                    1 => 'Austinville',
                    2 => 'Queensland',
                    3 => ' 4213',
                    4 => ' ',
                ),
            431 =>
                array (
                    0 => '431',
                    1 => 'Austral',
                    2 => 'New South Wales',
                    3 => ' 2179',
                    4 => ' ',
                ),
            432 =>
                array (
                    0 => '432',
                    1 => 'Austral Eden',
                    2 => 'New South Wales',
                    3 => ' 2440',
                    4 => ' ',
                ),
            433 =>
                array (
                    0 => '433',
                    1 => 'Australia Plains',
                    2 => 'South Australia',
                    3 => ' 5374',
                    4 => ' ',
                ),
            434 =>
                array (
                    0 => '434',
                    1 => 'Australind',
                    2 => 'Western Australia',
                    3 => ' 6233',
                    4 => ' ',
                ),
            435 =>
                array (
                    0 => '435',
                    1 => 'Avalon',
                    2 => 'Victoria',
                    3 => ' 3212',
                    4 => ' ',
                ),
            436 =>
                array (
                    0 => '436',
                    1 => 'Avalon Beach',
                    2 => 'New South Wales',
                    3 => ' 2107',
                    4 => ' ',
                ),
            437 =>
                array (
                    0 => '437',
                    1 => 'Aveley',
                    2 => 'Western Australia',
                    3 => ' 6069',
                    4 => ' ',
                ),
            438 =>
                array (
                    0 => '438',
                    1 => 'Avenel',
                    2 => 'Victoria',
                    3 => ' 3664',
                    4 => ' ',
                ),
            439 =>
                array (
                    0 => '439',
                    1 => 'Avenell Heights',
                    2 => 'Queensland',
                    3 => ' 4670',
                    4 => ' ',
                ),
            440 =>
                array (
                    0 => '440',
                    1 => 'Avenue Range',
                    2 => 'South Australia',
                    3 => ' 5273',
                    4 => ' ',
                ),
            441 =>
                array (
                    0 => '441',
                    1 => 'Avisford',
                    2 => 'New South Wales',
                    3 => ' 2850',
                    4 => ' ',
                ),
            442 =>
                array (
                    0 => '442',
                    1 => 'Avoca',
                    2 => 'New South Wales',
                    3 => ' 2577',
                    4 => ' ',
                ),
            443 =>
                array (
                    0 => '443',
                    1 => 'Avoca',
                    2 => 'Queensland',
                    3 => ' 4670',
                    4 => ' ',
                ),
            444 =>
                array (
                    0 => '444',
                    1 => 'Avoca',
                    2 => 'Tasmania',
                    3 => ' 7213',
                    4 => ' ',
                ),
            445 =>
                array (
                    0 => '445',
                    1 => 'Avoca',
                    2 => 'Victoria',
                    3 => ' 3467',
                    4 => ' ',
                ),
            446 =>
                array (
                    0 => '446',
                    1 => 'Avoca Beach',
                    2 => 'New South Wales',
                    3 => ' 2251',
                    4 => ' ',
                ),
            447 =>
                array (
                    0 => '447',
                    1 => 'Avoca Dell',
                    2 => 'South Australia',
                    3 => ' 5253',
                    4 => ' ',
                ),
            448 =>
                array (
                    0 => '448',
                    1 => 'Avoca Vale',
                    2 => 'Queensland',
                    3 => ' 4314',
                    4 => ' ',
                ),
            449 =>
                array (
                    0 => '449',
                    1 => 'Avon',
                    2 => 'New South Wales',
                    3 => ' 2574',
                    4 => ' ',
                ),
            450 =>
                array (
                    0 => '450',
                    1 => 'Avon',
                    2 => 'South Australia',
                    3 => ' 5501',
                    4 => ' ',
                ),
            451 =>
                array (
                    0 => '451',
                    1 => 'Avondale',
                    2 => 'New South Wales',
                    3 => ' 2530',
                    4 => ' ',
                ),
            452 =>
                array (
                    0 => '452',
                    1 => 'Avondale',
                    2 => 'Queensland',
                    3 => ' 4670',
                    4 => ' ',
                ),
            453 =>
                array (
                    0 => '453',
                    1 => 'Avondale Heights',
                    2 => 'Victoria',
                    3 => ' 3034',
                    4 => ' ',
                ),
            454 =>
                array (
                    0 => '454',
                    1 => 'Avonmore',
                    2 => 'Victoria',
                    3 => ' 3559',
                    4 => ' ',
                ),
            455 =>
                array (
                    0 => '455',
                    1 => 'Avon Plains',
                    2 => 'Victoria',
                    3 => ' 3477',
                    4 => ' ',
                ),
            456 =>
                array (
                    0 => '456',
                    1 => 'Avonside',
                    2 => 'New South Wales',
                    3 => ' 2628',
                    4 => ' ',
                ),
            457 =>
                array (
                    0 => '457',
                    1 => 'Avonsleigh',
                    2 => 'Victoria',
                    3 => ' 3782',
                    4 => ' ',
                ),
            458 =>
                array (
                    0 => '458',
                    1 => 'Avon Valley National Park',
                    2 => 'Western Australia',
                    3 => ' 6084',
                    4 => ' ',
                ),
            459 =>
                array (
                    0 => '459',
                    1 => 'Awaba',
                    2 => 'New South Wales',
                    3 => ' 2283',
                    4 => ' ',
                ),
            460 =>
                array (
                    0 => '460',
                    1 => 'Axe Creek',
                    2 => 'Victoria',
                    3 => ' 3551',
                    4 => ' ',
                ),
            461 =>
                array (
                    0 => '461',
                    1 => 'Axedale',
                    2 => 'Victoria',
                    3 => ' 3551',
                    4 => ' ',
                ),
            462 =>
                array (
                    0 => '462',
                    1 => 'Aylmerton',
                    2 => 'New South Wales',
                    3 => ' 2575',
                    4 => ' ',
                ),
            463 =>
                array (
                    0 => '463',
                    1 => 'Ayr',
                    2 => 'Queensland',
                    3 => ' 4807',
                    4 => ' ',
                ),
            464 =>
                array (
                    0 => '464',
                    1 => 'Ayrford',
                    2 => 'Victoria',
                    3 => ' 3268',
                ),
            465 =>
                array (
                    0 => NULL,
                ),
        );
       foreach ($a as $b){
           unset($b[0]);
            $c[]= implode(',',$b);
//           $c[] = $b[1] ?? '';
       }
        $array2 = array_values($c);
       dd($array2);
        $view = view($this->viewPath . 'create');
        return $this->repository->getCreateOrEditPage($view);
    }

    public function store(SenderRequest $request)
    {
        $attributes = $request->validated();
        try {
            DB::beginTransaction();
            $this->repository->create($attributes);
            DB::commit();
            return (new SuccessResponse($this->model, $request))->responseOk();
        } catch (\Exception $exception) {
            DB::rollBack();
            return (new ErrorResponse($this->model, $request, $exception))->responseError();
        }

    }


    public function show(int $id)
    {
        return view($this->viewPath . 'show');
    }


    public function edit(int $id)
    {
        return view($this->viewPath . 'edit');
    }


    public function update(Request $request, int $id)
    {
        //
    }


    public function destroy(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->repository->delete($id);
            DB::commit();
            return (new SuccessResponse($this->model, $request, 'delete'))->responseOk();
        } catch (\Exception $exception) {
            DB::rollBack();
            return (new ErrorResponse($this->model, $request, $exception, 'delete'))->responseError();
        }
    }
}
