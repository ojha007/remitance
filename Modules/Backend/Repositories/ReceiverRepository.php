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
            ->select('code', 'email', 'phone_number1', 'phone_number2', 'r.id',
                'first_name', 'middle_name', 'last_name', 'd.name as district', 'ward_number', 'street')
            ->join('receiver_address as ra', 'ra.receiver_id', '=', 'r.id')
            ->join('districts as d', 'd.id', '=', 'ra.district_id')
            ->whereNull('deleted_at')
            ->when($name, function ($q) use ($name) {
                $q->where('r.first_name', 'like', '%' . $name . '%')
                    ->orWhere('r.middle_name', 'like', '%' . $name . '%')
                    ->orWhere('r.last_name', 'LIKE', '%' . $name . '%');
            })
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getCreateOrEditPage($view)
    {
        $attributes = (new SenderRepository(new Sender()))->getCommonViewPageData('Nepal');
        $issuedBy = Receiver::getIssuedByArray();
        $selectBanks = Cache::rememberForever('allBanks', function () {
            return DB::table('banks')
                ->pluck('name', 'id')
                ->toArray();
        });
        $selectDistricts = Cache::rememberForever('districts', function () {
            return DB::table('districts')
                ->pluck('name', 'id')
                ->toArray();
        });
        return $view->with([
            'selectIssuedBy' => $issuedBy,
            'selectDistricts' => $selectDistricts,
            'selectBanks' => $selectBanks,
            'selectMps' => [],
        ])->with($attributes);
    }

    public function getReceiverById($id): \Illuminate\Support\Collection
    {

        return DB::table('receivers as r')
            ->select('r.id','first_name', 'last_name', 'middle_name', 'code',
                'id_number', 'issued_by', 'is_active', 'email', 'street',
                'ward_number', 'tole_number','phone_number1','phone_number2','is_default',
                'b.name as bank_name', 'branch', 'account_number','expiry_date','account_name',
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
            ->get();
    }

}
