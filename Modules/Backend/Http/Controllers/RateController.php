<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\Rate;
use Modules\Backend\Http\Requests\RateRequest;
use Modules\Backend\Http\Response\ErrorResponse;
use Modules\Backend\Http\Response\SuccessResponse;
use Modules\Backend\Http\Services\DataTableButton;
use Modules\Backend\Repositories\RateRepository;
use Yajra\DataTables\DataTables;

class RateController extends Controller
{

    protected $viewPath = 'backend::rates.';

    protected $modal = 'modal-rate';
    protected $baseRoute = 'backend.rates.';
    /**
     * @var Rate
     */
    private $model;
    /**
     * @var RateRepository
     */
    private $repository;


    public function __construct(Rate $rate)
    {
        $this->model = $rate;
        $this->repository = new RateRepository($rate);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request)
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
    public function create()
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
     * @param int $id
     * @return Renderable
     */
    public function show(int $id)
    {
        return view('backend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id)
    {
        return view('backend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
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
