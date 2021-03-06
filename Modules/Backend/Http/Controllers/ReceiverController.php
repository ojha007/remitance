<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\Receiver;
use Modules\Backend\Entities\Sender;
use Modules\Backend\Http\Requests\ReceiverRequest;
use Modules\Backend\Http\Response\ErrorResponse;
use Modules\Backend\Http\Response\SuccessResponse;
use Modules\Backend\Repositories\ReceiverRepository;
use Modules\Backend\Repositories\SenderRepository;

class ReceiverController extends Controller
{

    protected $viewPath = 'backend::receivers.';

    protected $baseRoute = 'admin.receivers.';

    private $model;
    /**
     * @var ReceiverRepository
     */
    private $repository;


    public function __construct(Receiver $receiver)
    {
        $this->model = $receiver;
        $this->repository = new ReceiverRepository($receiver);
        $this->middleware('permission:admin-permission');
        $this->middleware(['permission:receiver-view|receiver-create|receiver-edit|receiver-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:receiver-create'], ['only' => ['create', 'store', 'show']]);
        $this->middleware(['permission:receiver-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:receiver-delete'], ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        $receivers = $this->repository->getAllReceivers($request);
        return view($this->viewPath . 'index', compact('receivers'));
    }

    public function create(Request $request)
    {
        $view = view($this->viewPath . 'create');
        $sender_id = $request->route('sender_id');
        $banks = null;
        if ($sender_id)
            return $this->repository->getCreateOrEditPage($view)
                ->with(['banks' => $banks]);
        else {
            $selectSenders = (new SenderRepository(new Sender()))->selectSenders();
            return view($this->viewPath . 'selectSenders', compact('selectSenders'));
        }

    }

    public function show(Request $request, int $id)
    {
        $receiver = $this->repository->getReceiverById($id);
        if ($request->ajax()) {
            return response()->json($receiver[0]);
        }
        return view($this->viewPath . 'show', compact('receiver'));
    }

    public function store(ReceiverRequest $request)
    {

        $attributes = $request->except('bank_id', 'account_name',
            'account_number', 'branch', 'is_default', 'district_id',
            'country_id');
        try {
            DB::beginTransaction();
            $max_id = DB::table('receivers')->max('id');
            $attributes['code'] = Receiver::CODE . '-' . str_pad($max_id + 1, 4, 0, STR_PAD_LEFT);
            $attributes['created_by'] = auth()->id();
            $receiver = $this->repository->create($attributes);
            foreach ($request->get('bank_id') as $i => $bank_id) {
                DB::table('receiver_banks')
                    ->insert([
                        'receiver_id' => $receiver->id,
                        'bank_id' => $bank_id,
                        'branch' => $request->get('branch')[$i],
                        'account_name' => $request->get('account_name')[$i],
                        'account_number' => $request->get('account_number')[$i],
                        'is_default' => $request->get('is_default')[$i],
                    ]);
            }
            DB::table('receiver_address')
                ->insert([
                    'district_id' => $request->get('district_id'),
                    'receiver_id' => $receiver->id,
                    'street' => $request->get('street'),
                ]);
            $redirectRoute = route($this->baseRoute . 'show', $receiver->id);
            DB::commit();
            if ($request->has('reload')) {
                return response()->json([
                    'id' => $receiver->id,
                    'status' => 201,
                    'options' => $this->receiverBySender($receiver->sender_id),
                    'select' => '#receiver_id',
                    'dom' => '#receiver-detail'
                ]);
            }
            return (new SuccessResponse($this->model, $request, 'created', $redirectRoute))
                ->responseOk();
        } catch (\Exception $exception) {
            DB::rollBack();
            return (new ErrorResponse($this->model, $request, $exception))
                ->responseError();
        }

    }

    public function edit(int $id)
    {
        $receiver = $this->repository->getAllDetailById($id);
        $banks = DB::table('receiver_banks')
            ->select('bank_id', 'branch', 'account_name', 'account_number', 'is_default')
            ->where('receiver_id', '=', $id)
            ->get()
            ->toArray();
        $view = view($this->viewPath . 'edit');
        return $this->repository->getCreateOrEditPage($view)
            ->with(['receiver' => $receiver, 'banks' => $banks]);

    }

    public function receiverBySender($sender_id): \Illuminate\Support\Collection
    {
        return DB::table('receivers as r')
            ->select('r.id', 'r.name',
                'phone_number', 'd.name as district')
            ->join('receiver_address as ra', 'ra.receiver_id', '=', 'r.id')
            ->join('districts as d', 'd.id', '=', 'ra.district_id')
            ->where('r.sender_id', '=', $sender_id)
            ->whereNull('r.deleted_at')
            ->orderByDesc('id')
            ->get()->mapWithKeys(function ($receiver) {
                return [
                    $receiver->id => ucwords($receiver->name) . ' ' .
                        '[' . $receiver->phone_number . ' | ' . $receiver->district . ']'
                ];
            });
    }

    public function getReceiverBankDetails($id): \Illuminate\Http\JsonResponse
    {
        $data = DB::table('receiver_banks as rb')
            ->where('receiver_id', '=', $id);
        $banks = DB::table('banks')
            ->joinSub($data, 'data', function ($join) {
                $join->on('data.bank_id', '=', 'banks.id');
            })->get()->mapWithKeys(function ($bank) {
                return [
                    $bank->id => [
                        'bank_id' => $bank->bank_id,
                        'name' => $bank->name,
                        'account_number' => $bank->account_number,
                        'branch' => $bank->branch,
                        'account_name' => $bank->account_name,
                        'is_default' => $bank->is_default,

                    ]
                ];
            })->toArray();
        return response()->json([
            'banks' => $banks,
        ]);
    }
}
