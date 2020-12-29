<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backend\Entities\Receiver;
use Modules\Backend\Http\Services\DataTableButton;
use Modules\Backend\Repositories\ReceiverRepository;
use Modules\Backend\Repositories\SenderRepository;
use Yajra\DataTables\DataTables;

class ReceiverController extends Controller
{

    protected $viewPath = 'backend::receivers.';

    protected $baseRoute = 'admin.receivers.';

    private $model;
    /**
     * @var SenderRepository
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

//        if ($request->ajax()) {
//            $attributes['limit'] = $request->query('limit');
//            $receivers = $this->repository->getIndexPageData($attributes);
//            return $this->dataTableLists($receivers);
//        }
        return view($this->viewPath . 'index');
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


    public function create()
    {
        $view = view($this->viewPath . 'create');
        return $this->repository->getCreateOrEditPage($view);
    }

//    public function store(receiverRequest $request)
//    {
////        $attributes = $request->except('state_id', 'country_id', 'post_code');
////        try {
////            DB::beginTransaction();
////            $max_id = DB::table('senders')->max('id');
////            $code = $max_id + 1;
////            $attributes['code'] = Receiver::CODE . '-' . str_pad($code, 4, 0, STR_PAD_LEFT);
////            $attributes['created_by'] = auth()->id();
////            $this->repository->create($attributes);
////            DB::commit();
////            return (new SuccessResponse($this->model, $request, 'created', $this->baseRoute . 'index'))
////                ->responseOk();
////        } catch (\Exception $exception) {
////            DB::rollBack();
////            return (new ErrorResponse($this->model, $request, $exception))
////                ->responseError();
////        }
//
//    }


    public function show(int $id)
    {
        $receiver = $this->repository->getAllDetailById($id);
        return view($this->viewPath . 'show', compact('receiver'));
    }


    public function edit(int $id)
    {
        $receiver = $this->repository->getAllDetailById($id);
        $view = view($this->viewPath . 'edit');
        return $this->repository->getCreateOrEditPage($view)
            ->with(['receiver' => $receiver]);

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
