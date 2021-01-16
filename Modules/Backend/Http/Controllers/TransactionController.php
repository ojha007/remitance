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

    public function index(Request $request)
    {
        dd($request);
    }

    public function show($id)
    {

        try {
            $oldStatusId = DB::table('transaction_status as ts')
                ->where('transaction_id', '=', $id)
                ->get()->map(function ($t) {
                    return $t->status_id;
                })->toArray();
            $selectStatus = DB::table('statuses')
                ->whereNotIn('id', $oldStatusId)
                ->get()->mapWithKeys(function ($status) {
                    return [$status->id => $status->name];
                })->toArray();
            $latestStatus = (new BackendController())
                ->getLatestStatusOfTransactions()
                ->where('ts.transaction_id', '=', $id);
            $transaction = DB::table('transactions as tr')
                ->select(
                    'statuses.name as status',
                    'tr.rate',
                    'tr.date',
                    'tr.code',
                    'tr.id',
                    'tr.notes',
                    'tr.sending_amount',
                    'tr.receiving_amount',
                    'tr.charge',
                    'pt.name as payment_type',
                    'senders.email as s_email',
                    'senders.phone_number as s_phone_number',
                    'rd.name as r_district',
                    'rs.name as r_state',
                    'rc.name  as r_country',
                    'ss.name  as s_suburb',
                    'sst.name as s_state',
                    'sc.name as s_country',
                    'b.name as bank',
                    'rb.branch',
                    'rb.account_number',
                    'rb.account_name',
                    'ss.post_code',
                    'u.name as created_by',
                    'receivers.phone_number as r_phone_number',
                    'senders.name as sender',
                    'receivers.name as receiver')
                ->join('senders', 'senders.id', '=', 'tr.sender_id')
                ->join('receivers', 'receivers.id', '=', 'tr.receiver_id')
                ->join('receiver_address as ra', 'receivers.id', '=', 'ra.receiver_id')
                ->join('districts as rd', 'rd.id', 'ra.receiver_id')
                ->join('states as rs', 'rs.id', '=', 'rd.state_id')
                ->join('countries as rc', 'rc.id', '=', 'rs.country_id')
                ->join('suburbs as ss', 'ss.id', '=', 'senders.suburb_id')
                ->join('states as sst', 'sst.id', '=', 'ss.state_id')
                ->join('countries as sc', 'sc.id', '=', 'sst.country_id')
                ->join('receiver_banks as rb', 'rb.id', '=', 'tr.receiver_bank_id')
                ->join('banks as b', 'b.id', '=', 'rb.bank_id')
                ->join('users as u', 'u.id', '=', 'tr.created_by')
                ->joinSub($latestStatus, 'ls', function ($join) {
                    $join->on('ls.transaction_id', '=', 'tr.id');
                })->join('statuses', 'statuses.id', '=', 'ls.status_id')
                ->join('payment_types as pt', 'pt.id', '=', 'tr.payment_type_id')
                ->where('tr.id', '=', $id)
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
            return view($this->viewPath . 'show', compact('transactionStatues', 'transaction', 'selectStatus'));
        } catch (\Exception $exception) {
            dd($exception);
        }
    }

    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|exists:statuses,id',
            'notes' => 'nullable'
        ]);
        try {
            DB::beginTransaction();
            DB::table('transaction_status')
                ->insert([
                    'date' => now()->format('Y-m-d'),
                    'status_id' => $request->get('status_id'),
                    'transaction_id' => $id,
                    'notes' => $request->get('notes'),
                    'causer_id' => auth()->id()
                ]);
            DB::commit();
            return (new SuccessResponse('Transactions', $request, 'status changed'))->responseOk();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Failed to change transaction status .');
        }

    }
}
