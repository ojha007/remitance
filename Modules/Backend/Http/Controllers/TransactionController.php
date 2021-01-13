<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\Rate;
use Modules\Backend\Entities\SendMoney;
use Modules\Backend\Http\Requests\RateRequest;
use Modules\Backend\Http\Response\ErrorResponse;
use Modules\Backend\Http\Response\SuccessResponse;
use Modules\Backend\Http\Services\DataTableButton;
use Modules\Backend\Repositories\RateRepository;
use Modules\Backend\Repositories\TransactionRepository;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{

    protected $viewPath = 'backend::transactions.';


    protected $baseRoute = 'admin.transactions.';
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
    }


    public function show($id)
    {

        try {
            $latestStatus = (new BackendController())
                ->getLatestStatusOfTransactions()
                ->where('ts.transaction_id', '=', $id);
            $transaction = DB::table('transactions')
                ->select('statuses.name as status', 'transactions.*',
                    'pt.name as payment_type', 'senders.email as s_email',
                    'senders.phone_number as s_phone_number',
                    'receivers.email as r_email', 'receivers.phone_number1 as r_phone_number')
                ->selectRaw('CONCAT(senders.first_name," ", senders.last_name) as sender')
                ->selectRaw('CONCAT(receivers.first_name," ", receivers.last_name) as receiver')
                ->join('senders', 'senders.id', '=', 'transactions.sender_id')
                ->join('receivers', 'receivers.id', '=', 'transactions.receiver_id')
                ->joinSub($latestStatus, 'ls', function ($join) {
                    $join->on('ls.transaction_id', '=', 'transactions.id');
                })->join('statuses', 'statuses.id', '=', 'ls.status_id')
                ->join('payment_types as pt', 'pt.id', '=', 'transactions.payment_type_id')
                ->where('transactions.id', '=', $id)
                ->first();
            $transactionStatues = DB::table('transaction_status as ts')
                ->select('s.name as status', 'u.name as causer',
                    't.date', 't.code')
                ->join('statuses as s', 's.id', '=', 'ts.status_id')
                ->join('transactions as t', 't.id', '=', 'ts.transaction_id')
                ->join('users as u', 'u.id', '=', 'ts.causer_id')
                ->orderByDesc('ts.id')
                ->where('t.id', '=', $id)
                ->get();
            return view($this->viewPath . 'show', compact('transactionStatues', 'transaction'));
        } catch (\Exception $exception) {
            dd($exception);
        }
    }
}
