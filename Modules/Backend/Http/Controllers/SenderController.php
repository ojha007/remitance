<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\Sender;
use Modules\Backend\Http\Requests\RateRequest;
use Modules\Backend\Http\Response\ErrorResponse;
use Modules\Backend\Http\Response\SuccessResponse;
use Modules\Backend\Http\Services\DataTableButton;
use Modules\Backend\Repositories\SenderRepository;
use Yajra\DataTables\DataTables;

class SenderController extends Controller
{

    protected $viewPath = 'backend::senders.';

    protected $baseRoute = 'admin.senders.';

    private $model;
    /**
     * @var SenderRepository
     */
    private $repository;


    public function __construct(Sender $sender)
    {
        $this->model = $sender;
        $this->repository = new SenderRepository($sender);
    }


    public function index(Request $request)
    {

        if ($request->ajax()) {
            $rates = $this->repository->select('id', 'date', 'customer_rate', 'agent_rate');
            return $this->dataTableLists($rates);
        }
        return view($this->viewPath . 'index');
    }

    protected function dataTableLists(Collection $collection)
    {
        $dataTableButton = new DataTableButton();
        return DataTables::make($collection)
            ->addColumn('action', function ($rate) use ($dataTableButton) {
                $button = '';
                $button .= $dataTableButton->editButton($this->baseRoute . 'edit', $rate->id);
                $button .= $dataTableButton->deleteButton($this->baseRoute . 'destroy', $rate->id);
                return $button;
            })
            ->toJson();
    }


    public function create()
    {

        return view($this->viewPath . 'create');
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


    public function show(int $id)
    {
        return view($this->viewPath . 'show');
    }


    public function edit(int $id)
    {
        return view($this->viewPath . 'edit');
    }


    public function update(Request $request, int $id)
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
