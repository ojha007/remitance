<?php


namespace Modules\Backend\Repositories;


use App\Repositories\Repository;
use Modules\Backend\Entities\SendMoney;

class TransactionRepository extends Repository
{

    public function __construct(SendMoney $model)
    {
        $this->model = $model;

    }


}
