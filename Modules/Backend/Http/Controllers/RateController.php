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

    protected $baseRoute = 'admin.rates.';
    protected $perPage = 20;
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
        $this->middleware('auth');
        $this->middleware('permission:admin-permission');
        $this->middleware(['permission:rate-view|rate-create|rate-edit|rate-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:rate-create'], ['only' => ['create', 'store', 'show']]);
        $this->middleware(['permission:rate-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:rate-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {

        $rates = $this->repository->paginate($this->perPage);
        return view($this->viewPath . 'index', compact('rates'))
            ->with(['modal' => $this->modal]);
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
