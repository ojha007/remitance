<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\Receiver;
use Modules\Backend\Entities\Sender;
use Modules\Backend\Http\Requests\SenderRequest;
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
        $this->middleware('permission:admin-permission');
        $this->middleware(['permission:sender-view|sender-create|sender-edit|sender-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:sender-create'], ['only' => ['create', 'store', 'show']]);
        $this->middleware(['permission:sender-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:sender-delete'], ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $attributes['limit'] = $request->query('limit');
            $senders = $this->repository->getIndexPageData($attributes);
            return $this->dataTableLists($senders);
        }
        return view($this->viewPath . 'index');
    }

    protected function dataTableLists($collection)
    {
        $dataTableButton = new DataTableButton();
        return DataTables::make($collection)
            ->editColumn('is_active', function ($sender) {
                return spanByStatus($sender->is_active);
            })
            ->addColumn('action', function ($sender) use ($dataTableButton) {
                $button = '';
                if (auth()->user()->can('sender-view'))
                    $button .= $dataTableButton->viewButton($this->baseRoute . 'show', $sender->id);
                if (auth()->user()->can('sender-edit'))
                    $button .= $dataTableButton->editButton($this->baseRoute . 'edit', $sender->id);
                if (auth()->user()->can('sender-delete'))
                    $button .= $dataTableButton->deleteButton($this->baseRoute . 'destroy', $sender->id);
                return $button;
            })
            ->rawColumns(['is_active', 'action'])
            ->toJson();
    }


    public function create()
    {
        $view = view($this->viewPath . 'create');
        return $this->repository->getCreateOrEditPage($view);
    }

    public function store(SenderRequest $request)
    {
        $attributes = $request->except('state_id', 'country_id', 'post_code');
        try {
            DB::beginTransaction();
            $max_id = DB::table('senders')->max('id');
            $code = $max_id + 1;
            $attributes['code'] = Receiver::CODE . '-' . str_pad($code, 4, 0, STR_PAD_LEFT);
            $attributes['created_by'] = auth()->id();
            $this->repository->create($attributes);
            DB::commit();
            return (new SuccessResponse($this->model, $request, 'created', $this->baseRoute . 'index'))
                ->responseOk();
        } catch (\Exception $exception) {
            DB::rollBack();
            return (new ErrorResponse($this->model, $request, $exception))
                ->responseError();
        }

    }


    public function show(int $id)
    {
        $sender = $this->repository->getAllDetailById($id);
        return view($this->viewPath . 'show', compact('sender'));
    }


    public function edit(int $id)
    {
        $sender = $this->repository->getAllDetailById($id);
        $view = view($this->viewPath . 'edit');
        return $this->repository->getCreateOrEditPage($view)
            ->with(['sender' => $sender]);

    }


    public function update(SenderRequest $request, int $id)
    {
        $attributes = $request->except('state_id', 'country_id', 'post_code');
        try {
            DB::beginTransaction();
            $attributes['updated_by'] = auth()->id();
            $this->repository->update($id, $attributes);
            DB::commit();
            $path = route($this->baseRoute . 'show', $id);
            return (new SuccessResponse($this->model, $request, 'updated', $path))
                ->responseOk();
        } catch (\Exception $exception) {
            DB::rollBack();
            return (new ErrorResponse($this->model, $request, $exception))
                ->responseError();
        }
    }


    public function destroy(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->repository->delete($id);
            DB::commit();
            $redirectPath = $this->baseRoute . 'index';
            return (new SuccessResponse($this->model, $request, 'delete', $redirectPath))->responseOk();
        } catch (\Exception $exception) {
            DB::rollBack();
            return (new ErrorResponse($this->model, $request, $exception, 'delete'))->responseError();
        }
    }

    public function changeStatus(Request $request, $id)
    {

        try {
            $this->repository->update($id, [
                'is_active' => !$request->get('is_active')
            ]);
            return (new SuccessResponse($this->model, $request, 'updated'))->responseOk();
        } catch (\Exception $exception) {
            return (new ErrorResponse($this->model, $request, $exception))->responseError();
        }

    }
}
