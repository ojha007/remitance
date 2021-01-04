<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\Rate;
use Modules\Backend\Entities\Sender;
use Modules\Backend\Entities\SendMoney;
use Modules\Backend\Http\Requests\SendMoneyRequest;
use Modules\Backend\Http\Response\ErrorResponse;
use Modules\Backend\Http\Response\SuccessResponse;
use Modules\Backend\Repositories\RateRepository;
use Modules\Backend\Repositories\SenderRepository;
use Modules\Backend\Repositories\TransactionRepository;

class SendMoneyController extends Controller
{

    protected $viewPath = 'backend::send-money.';


    protected $baseRoute = 'admin.send-money.';
    /**
     * @var Rate
     */
    private $model;
    /**
     * @var RateRepository
     */
    private $repository;


    public function __construct(SendMoney $sendMoney)
    {
        $this->model = $sendMoney;
        $this->repository = new TransactionRepository($sendMoney);
        $this->middleware('auth');
        $this->middleware('permission:admin-permission');
        $this->middleware(['permission:send-money-create'], ['only' => ['create']]);
        $this->middleware(['permission:send-money-create'], ['only' => ['create', 'store']]);
    }


    public function create()
    {
        $selectSenders = (new SenderRepository(new Sender()))->selectSenders();
        return view($this->viewPath . 'create', compact('selectSenders'));

    }

    public function store(SendMoneyRequest $request)
    {
        try {
            $attributes = $request->validated();
            DB::beginTransaction();
            $this->repository->create($attributes);
            DB::commit();
            return (new SuccessResponse($this->model, $request, 'created'))
                ->responseOk();
        } catch (\Exception $exception) {
            DB::rollBack();
            return (new ErrorResponse($this->model, $request, $exception))
                ->responseError();
        }
    }


}
