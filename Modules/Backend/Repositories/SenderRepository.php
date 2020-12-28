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

    public function select(...$array)
    {
        return $this->model->select($array)->get();
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
        $idTypes = Cache::rememberForever('id_types', function () {
            return DB::table('identity_types')
                ->pluck('name', 'id')
                ->toArray();
        });

        return $view->with([
            'selectCountries' => $countries,
            'selectStates' => $states,
            'selectIdentityTypes' => $idTypes
        ]);
    }
}
