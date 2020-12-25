<?php


namespace Modules\Backend\Repositories;


use App\Repositories\Repository;
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
}
