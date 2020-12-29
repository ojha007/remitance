<?php


namespace Modules\Backend\Repositories;


use App\Repositories\Repository;
use Modules\Backend\Entities\Receiver;

class ReceiverRepository extends Repository
{

    public function __construct(Receiver $receiver)
    {
        $this->model = $receiver;
    }


}
