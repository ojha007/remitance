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
        $widgets = [];
        $widgets['Total Senders'] = [
            'total' => DB::table('senders')->count('id'),
            'icon' => 'fa fa-user',
            'bg' => 'bg-aqua',
            'url' => route('admin.senders.index')
        ];
        $widgets['Total Receivers'] = [
            'total' => DB::table('receivers')->count('id'),
            'icon' => 'fa fa-user-plus',
            'bg' => 'bg-green',
            'url' => route('admin.receivers.index')
        ];
        $widgets['Today Transactions'] = [
            'total' => DB::table('transactions')->count('id'),
            'icon' => 'fa fa-paper-plane',
            'bg' => 'bg-blue',
            'url' => '#'
        ];
        $widgets['Today Customer Rate'] = [
            'total' => DB::table('rates')
                ->latest()->first()
                ->customer_rate,
            'icon' => 'fa fa-dollar',
            'bg' => 'bg-yellow',
            'url' => route('admin.rates.index')
        ];
        $allTransactions = $this->getAllTransactionsWithStatus();
        $latestTransactions = [];
        return view('backend::index', compact('widgets', 'allTransactions', 'latestTransactions'));
    }

    public function getStates($country_id): array
    {

        return DB::table('states')
            ->when($country_id, function ($q) use ($country_id) {
                $q->where('country_id', '=', $country_id);
            })->pluck('name', 'id')
            ->toArray();

    }

    public function getSuburbs($state_id): array
    {

        return DB::table('suburbs')
            ->when($state_id, function ($q) use ($state_id) {
                $q->where('state_id', '=', $state_id);
            })->pluck('name', 'id')
            ->toArray();

    }

    public function getDistricts($state_id): array
    {

        return DB::table('districts')
            ->when($state_id, function ($q) use ($state_id) {
                $q->where('state_id', '=', $state_id);
            })->pluck('name', 'id')
            ->toArray();


    }

    public function getMunicipalities($district_id): array
    {

        return DB::table('municipalities')
            ->when($district_id, function ($q) use ($district_id) {
                $q->where('district_id', '=', $district_id);
            })->pluck('name', 'id')
            ->toArray();

    }

    protected function getAllTransactionsWithStatus(): array
    {
        return [];
    }

}
