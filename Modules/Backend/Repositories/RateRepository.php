<?php


namespace Modules\Backend\Repositories;


use App\Repositories\Repository;
use Modules\Backend\Entities\Rate;

class RateRepository extends Repository
{

    public function __construct(Rate $rate)
    {
        $this->model = $rate;
    }

    public function select(...$array)
    {
        return $this->model->select($array)->get();
    }
}
