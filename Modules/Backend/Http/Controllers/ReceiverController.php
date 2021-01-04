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
        if ($sender_id)
            return $this->repository->getCreateOrEditPage($view);
        else {
            $selectSenders = (new SenderRepository(new Sender()))->selectSenders();
            return view($this->viewPath . 'selectSenders', compact('selectSenders'));
        }

    }

    public function show(int $id)
    {
        $receiver = $this->repository->getReceiverById($id);
//        dd($receiver);
        return view($this->viewPath . 'show', compact('receiver'));
    }

    public function store(ReceiverRequest $request)
    {

        $attributes = $request->except('bank_id', 'account_name',
            'account_number', 'branch', 'is_default', 'district_id',
            'country_id');
        try {
//            dd($request->all());
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
                    'ward_number' => $request->get('ward_number'),
                    'tole_number' => $request->get('tole_number'),
                    'street' => $request->get('street'),
                ]);
            $redirectRoute = route($this->baseRoute . 'show', $receiver->id);
            DB::commit();
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
//        dd($receiver);
        $view = view($this->viewPath . 'edit');
        return $this->repository->getCreateOrEditPage($view)
            ->with(['receiver' => $receiver]);

    }

    protected function dataTableLists($collection)
    {
//        $dataTableButton = new DataTableButton();
//        return DataTables::make($collection)
//            ->editColumn('is_active', function ($receiver) {
//                return spanByStatus($receiver->is_active);
//            })
//            ->addColumn('action', function ($receiver) use ($dataTableButton) {
//                $button = '';
//                if (auth()->user()->can('receiver-view'))
//                    $button .= $dataTableButton->viewButton($this->baseRoute . 'show', $receiver->id);
//                if (auth()->user()->can('receiver-edit'))
//                    $button .= $dataTableButton->editButton($this->baseRoute . 'edit', $receiver->id);
//                if (auth()->user()->can('receiver-delete'))
//                    $button .= $dataTableButton->deleteButton($this->baseRoute . 'destroy', $receiver->id);
//                return $button;
//            })
//            ->rawColumns(['is_active', 'action'])
//            ->toJson();
    }


//    public function update(SenderRequest $request, int $id)
//    {
//        $attributes = $request->except('state_id', 'country_id', 'post_code');
//        try {
//            DB::beginTransaction();
//            $attributes['updated_by'] = auth()->id();
//            $this->repository->update($id, $attributes);
//            DB::commit();
//            $path = route($this->baseRoute . 'show', $id);
//            return (new SuccessResponse($this->model, $request, 'updated', $path))
//                ->responseOk();
//        } catch (\Exception $exception) {
//            DB::rollBack();
//            return (new ErrorResponse($this->model, $request, $exception))
//                ->responseError();
//        }
//    }
//

//    public function destroy(Request $request, $id)
//    {
//        try {
//            DB::beginTransaction();
//            $this->repository->delete($id);
//            DB::commit();
//            $redirectPath = $this->baseRoute . 'index';
//            return (new SuccessResponse($this->model, $request, 'delete', $redirectPath))->responseOk();
//        } catch (\Exception $exception) {
//            DB::rollBack();
//            return (new ErrorResponse($this->model, $request, $exception, 'delete'))->responseError();
//        }
//    }


}
