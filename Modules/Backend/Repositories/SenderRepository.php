<?php


namespace Modules\Backend\Repositories;


use App\Repositories\Repository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\Receiver;
use Modules\Backend\Entities\Sender;

class SenderRepository extends Repository
{

    /**
     * SenderRepository constructor.
     * @param Sender $sender
     */
    public function __construct(Sender $sender)
    {
        $this->model = $sender;
    }

    public function getIndexPageData($attributes): \Illuminate\Support\Collection
    {
        return DB::table('senders')
            ->select('id', 'code', 'is_active')
            ->selectRaw('CONCAT(first_name," ",last_name) as name')
            ->limit($attributes['limit'])
            ->get();
    }

    public function getCreateOrEditPage($view)
    {
        $suburbs = Cache::rememberForever('suburbs', function () {
            return DB::table('suburbs')
                ->pluck('name', 'id')
                ->toArray();
        });
        $issuedBy = Receiver::getIssuedByArray();
        return $view->with([
            'selectSuburbs' => $suburbs,
            'selectIssuedBy' => $issuedBy
        ])->with(
            $this->getCommonViewPageData()
        );
    }

    public function getCommonViewPageData($country = 'Nepal'): array
    {
        $countries = Cache::rememberForever('countries', function () {
            return DB::table('countries')
                ->pluck('name', 'id')
                ->toArray();
        });
        $idTypes = Cache::rememberForever('idTypes', function () {
            return DB::table('identity_types')
                ->pluck('name', 'id')
                ->toArray();
        });
        $selectStates = Cache::rememberForever('states_' . $country, function () use ($country) {
            return DB::table('states')
                ->join('countries', 'states.country_id', '=', 'countries.id')
                ->where('countries.name', '=', $country)
                ->pluck('states.name', 'states.id')
                ->toArray();
        });
        return [
            'selectCountries' => $countries,
            'selectStates' => $selectStates,
            'selectIdentityTypes' => $idTypes,
        ];
    }

    public function getAllDetailById($id)
    {
        return DB::table('senders as se')
            ->select('se.id', 'email', 'phone_number', 'code', 'id_number', 'file',
                'street', 'date_of_birth', 'co.name as country', 'su.name as suburb',
                'issued_by', 'se.first_name', 'se.last_name', 'state_id', 'country_id',
                'suburb_id', 'identity_type_id',
                'st.name as state', 'post_code', 'expiry_date', 'is_active', 'it.name as identity_type')
            ->join('suburbs as su', 'su.id', '=', 'se.suburb_id')
            ->join('states as st', 'st.id', '=', 'su.state_id')
            ->join('countries as co', 'co.id', '=', 'st.country_id')
            ->join('identity_types as it', 'it.id', '=', 'se.identity_type_id')
            ->where('se.id', '=', $id)
            ->whereNull('deleted_at')
            ->first();
    }

    public function selectSenders(): array
    {
        return DB::table('senders as se')
            ->select('se.id', 'code')
            ->selectRaw('CONCAT(first_name," " ,last_name) as name')
            ->selectRaw('CONCAT(su.name," ," ,st.name) as address')
            ->join('suburbs as su', 'su.id', '=', 'se.suburb_id')
            ->join('states as st', 'st.id', '=', 'su.state_id')
            ->whereNull('deleted_at')
            ->get()->mapWithKeys(function ($sender) {
                return [$sender->id => ucwords($sender->name) . ' (' . ucwords($sender->address) . ')'];
            })->toArray();

    }
}