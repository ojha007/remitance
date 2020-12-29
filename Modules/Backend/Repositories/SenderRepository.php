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

    public function getIndexPageData($attributes)
    {
        return DB::table('senders')
            ->select('id', 'code', 'is_active')
            ->selectRaw('CONCAT(first_name," ",last_name) as name')
            ->limit($attributes['limit'])
            ->get();
    }

    public function getCreateOrEditPage($view)
    {
        $countries = Cache::rememberForever('countries', function () {
            return DB::table('countries')
                ->pluck('name', 'id')
                ->toArray();
        });
        $states = Cache::rememberForever('states', function () {
            return DB::table('states')
                ->pluck('name', 'id')
                ->toArray();
        });
        $idTypes = Cache::rememberForever('idTypes', function () {
            return DB::table('identity_types')
                ->pluck('name', 'id')
                ->toArray();
        });
        $suburbs = Cache::rememberForever('suburbs', function () {
            return DB::table('suburbs')
                ->pluck('name', 'id')
                ->toArray();
        });
        $issuedBy = Receiver::getIssuedByArray();

        return $view->with([
            'selectCountries' => $countries,
            'selectStates' => $states,
            'selectSuburbs' => $suburbs,
            'selectIdentityTypes' => $idTypes,
            'selectIssuedBy' => $issuedBy
        ]);
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
}
