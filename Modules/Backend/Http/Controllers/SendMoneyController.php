<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\Rate;
use Modules\Backend\Entities\Receiver;
use Modules\Backend\Entities\Sender;
use Modules\Backend\Entities\SendMoney;
use Modules\Backend\Http\Requests\SendMoneyRequest;
use Modules\Backend\Http\Response\ErrorResponse;
use Modules\Backend\Http\Response\SuccessResponse;
use Modules\Backend\Repositories\RateRepository;
use Modules\Backend\Repositories\ReceiverRepository;
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
        $selectPaymentTypes = DB::table('payment_types')
            ->pluck('name', 'id')
            ->toArray();
        $selectDistricts = (new ReceiverRepository(new Receiver()))->selectDistricts();
        return view($this->viewPath . 'create', compact('selectSenders', 'selectPaymentTypes', 'selectDistricts'));

    }

    public function store(SendMoneyRequest $request)
    {
        try {
            $attributes = $request->validated();
            DB::beginTransaction();
            $max_id = DB::table('transactions')->max('id');
            $attributes['code'] = Receiver::CODE . '-' . str_pad($max_id + 1, 4, 0, STR_PAD_LEFT);
            $attributes['created_by'] = auth()->id();
            $currency_id = DB::table('currencies')
                ->where('code', '=', 'NPR')
                ->first()->id;
            $status_id = DB::table('statuses')
                ->where('name', '=', SendMoney::AWAITING)
                ->first()
                ->id;
            $attributes['currency_id'] = $currency_id;
            $attributes['receiving_amount'] = $request->get('sending_amount') * $request->get('rate');
            $transaction = $this->repository->create($attributes);
            DB::table('transaction_status')
                ->insert([
                    'date' => $request->get('date'),
                    'status_id' => $status_id,
                    'transaction_id' => $transaction->id,
                    'causer_id' => $attributes['created_by'],
                    'notes' => null,
                ]);
            DB::commit();
            return (new SuccessResponse($this->model, $request, 'created'))
                ->responseOk();
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
            return (new ErrorResponse($this->model, $request, $exception))
                ->responseError();
        }
    }


}
