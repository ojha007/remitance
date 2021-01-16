<?php


namespace Modules\Backend\Repositories;


use App\Repositories\Repository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\Receiver;
use Modules\Backend\Entities\Sender;

class ReceiverRepository extends Repository
{

    /**
     * ReceiverRepository constructor.
     * @param Receiver $receiver
     */
    public function __construct(Receiver $receiver)
    {
        $this->model = $receiver;
    }

    public function getAllReceivers($request): \Illuminate\Support\Collection
    {
        $name = $request->get('name');
        return DB::table('receivers as r')
            ->select('code',
                'phone_number', 'r.id', 'r.name', 'd.name as district',
                'street')
            ->join('receiver_address as ra', 'ra.receiver_id', '=', 'r.id')
            ->join('districts as d', 'd.id', '=', 'ra.district_id')
            ->whereNull('deleted_at')
            ->when($name, function ($q) use ($name) {
                $q->where('r.name', 'like', '%' . $name . '%');
            })
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getCreateOrEditPage($view = null)
    {
        $attributes = (new SenderRepository(new Sender()))->getCommonViewPageData('Nepal');
        $issuedBy = Receiver::getIssuedByArray();
        $selectBanks = Cache::rememberForever('allBanks', function () {
            return DB::table('banks')
                ->pluck('name', 'id')
                ->toArray();
        });
        $selectDistricts = $this->selectDistricts();
        $defaultCountry = DB::table('countries')->select('id')
            ->where('name', '=', 'Nepal')
            ->first()->id;
        $data = array_merge(['selectIssuedBy' => $issuedBy,
            'selectDistricts' => $selectDistricts,
            'selectBanks' => $selectBanks,
//            'selectMps' => [],
            'banks' => null,
            'defaultCountry' => $defaultCountry
        ], $attributes);

        if ($view) {
            return $view->with($data)->with(['button' => true]);
        } else return $data;

    }

    public function selectDistricts()
    {
        return Cache::rememberForever('districts', function () {
            return DB::table('districts')
                ->pluck('name', 'id')
                ->toArray();
        });
    }

    public function getReceiverById($id): \Illuminate\Support\Collection
    {

        return DB::table('receivers as r')
            ->select('r.id', 'r.name', 'code',
                'id_number', 'issued_by', 'is_active',  'street',
                'phone_number', 'is_default',
                'b.name as bank_name', 'branch', 'account_number', 'expiry_date', 'account_name',
                'd.name as district', 's.name as state', 'c.name as country',
                'date_of_birth', 'file', 'it.name as identity_type')
            ->join('identity_types as it', 'it.id', '=', 'r.identity_type_id')
            ->join('receiver_banks as rb', 'rb.receiver_id', '=', 'r.id')
            ->join('banks as b', 'b.id', '=', 'rb.bank_id')
            ->join('receiver_address as ra', 'ra.receiver_id', '=', 'r.id')
            ->join('districts as d', 'd.id', '=', 'ra.district_id')
            ->join('states as s', 's.id', '=', 'd.state_id')
            ->join('countries as c', 'c.id', '=', 's.country_id')
            ->where('r.id', '=', $id)
            ->whereNull('r.deleted_at')
            ->orderByDesc('r.id')
            ->get();
    }

    public function getAllDetailById($id)
    {
        return DB::table('receivers as re')
            ->select('re.id', 'phone_number', 'id_number',
                'street', 'date_of_birth', 'issued_by', 're.name',
                'state_id', 'country_id', 'ward_number', 'file',
                'district_id', 'identity_type_id',
                'expiry_date', 'is_active', 'it.name as identity_type')
            ->join('receiver_address as ra', 're.id', '=', 'ra.receiver_id')
            ->join('districts as d', 'd.id', '=', 'ra.district_id')
            ->join('states as st', 'st.id', '=', 'dt.state_id')
            ->join('countries as co', 'co.id', '=', 'st.country_id')
            ->join('identity_types as it', 'it.id', '=', 're.identity_type_id')
            ->where('re.id', '=', $id)
            ->whereNull('deleted_at')
            ->first();
    }

}
