<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class BackendController extends Controller
{

    public function __construct()
    {

        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('backend::index');
    }

    public function getStates($country_id): array
    {

        $states['states'] = DB::table('states')
            ->when($country_id, function ($q) use ($country_id) {
                $q->where('country_id', '=', $country_id);
            })->pluck('name', 'id')
            ->toArray();
        return $states;

    }

    public function getDistricts($state_id): array
    {
        $states = [];
        $states['districts'] = DB::table('districts')
            ->when($state_id, function ($q) use ($state_id) {
                $q->where('state_id', '=', $state_id);
            })->pluck('name', 'id')
            ->toArray();
        return $states;


    }

    public function getMunicipalities($district_id): array
    {
        $municipalities = [];
        $municipalities['municipalities'] = DB::table('municipalities')
            ->when($district_id, function ($q) use ($district_id) {
                $q->where('district_id', '=', $district_id);
            })->pluck('name', 'id')
            ->toArray();
        return $municipalities;
    }

}
