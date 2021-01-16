<?php


namespace Modules\Backend\Repositories;


use App\Repositories\Repository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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

    public function getIndexPageData($attributes, $limit): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return DB::table('senders as se')
            ->select('se.id', 'se.code', 'se.name', 'se.is_active',
                'su.name as suburb', 'co.name as country', 'st.name as states', 'se.street')
            ->join('suburbs as su', 'se.suburb_id', '=', 'su.id')
            ->join('states as st', 'su.state_id', '=', 'st.id')
            ->join('countries as co', 'co.id', '=', 'st.country_id')
            ->limit($attributes['limit'])
            ->paginate($limit);
    }

    public function getCreateOrEditPage($view = null)
    {
        $suburbs = Cache::rememberForever('Suburbs', function () {
            return DB::table('suburbs')
                ->orderBy('name')
                ->pluck('name', 'id')
                ->toArray();
        });
        $suburbs =[];
        $issuedBy = Sender::getIssuedByArray();
        $defaultCountry = DB::table('countries')
            ->select('id')
            ->where('name', '=', 'Australia')
            ->first()->id;
        $senderAttributes = ['selectSuburbs' => $suburbs, 'selectIssuedBy' => $issuedBy, 'defaultCountry' => $defaultCountry];
        $viewAttributes = array_merge($senderAttributes, $this->getCommonViewPageData('Australia'));
        if ($view)
            return $view->with($viewAttributes)->with(['button' => true]);
        return $viewAttributes;


    }

    public function getCommonViewPageData($country = 'Nepal'): array
    {

        $countries = Cache::rememberForever('countries', function () {
            return DB::table('countries')
                ->pluck('name', 'id')
                ->toArray();
        });
        $idTypes = Cache::rememberForever('idTypes_' . $country, function () {
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
                'issued_by', 'se.name', 'state_id', 'country_id',
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
            ->select('se.id', 'code', 'se.name')
            ->selectRaw('CONCAT(phone_number," | " ,email) as contact')
            ->selectRaw('CONCAT(su.name," | " ,st.name) as address')
            ->join('suburbs as su', 'su.id', '=', 'se.suburb_id')
            ->join('states as st', 'st.id', '=', 'su.state_id')
            ->whereNull('deleted_at')
            ->orderByDesc('id')
            ->get()->mapWithKeys(function ($sender) {
                return [
                    $sender->id => ucwords($sender->name) . ' [' . $sender->contact . '|' . ucwords($sender->address) . ']'
                ];
            })->toArray();

    }
}
