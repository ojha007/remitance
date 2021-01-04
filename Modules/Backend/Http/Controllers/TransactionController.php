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

    protected $viewPath = 'backend::send-money.';

    protected $modal = 'modal-rate';

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
        $this->middleware(['permission:send-money-view|send-money-create|send-money-edit|send-money-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:send-money-create'], ['only' => ['create', 'store', 'show']]);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {

        if ($request->ajax()) {
            $rates = $this->repository->select('id', 'date', 'customer_rate', 'agent_rate');
            return $this->dataTableLists($rates);
        }
        return view($this->viewPath . 'index')->with(['modal' => $this->modal]);
    }

    protected function dataTableLists(Collection $collection)
    {
        $dataTableButton = new DataTableButton();
        return DataTables::make($collection)
            ->addColumn('action', function ($rate) use ($dataTableButton) {
                $button = '';
                $button .= $dataTableButton->editButtonModal($rate->id, $this->modal);
                $button .= $dataTableButton->deleteButton($this->baseRoute . 'destroy', $rate->id);
                return $button;
            })
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {

        return view('backend::create');
    }

    public function store(RateRequest $request)
    {
        $attributes = $request->validated();
        try {
            DB::beginTransaction();
            $this->repository->create($attributes);
            DB::commit();
            return (new SuccessResponse($this->model, $request))->responseOk();
        } catch (\Exception $exception) {
            DB::rollBack();
            return (new ErrorResponse($this->model, $request, $exception))->responseError();
        }

    }

    /**
     * Show the specified resource.
     * @param  $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        return view('backend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id): Renderable
    {
        return view('backend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, int $id): Renderable
    {
        //
    }


    public function destroy(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->repository->delete($id);
            DB::commit();
            return (new SuccessResponse($this->model, $request, 'delete'))->responseOk();
        } catch (\Exception $exception) {
            DB::rollBack();
            return (new ErrorResponse($this->model, $request, $exception, 'delete'))->responseError();
        }
    }
}
