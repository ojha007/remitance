<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backend\Http\Services\GlobalServices;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{

    protected $viewPath = 'backend::roles.';

    protected $baseRoute = 'admin.roles.';


    public function __construct()
    {
        $this->middleware('permission:admin-permission');
        $this->middleware(['permission:role-view|role-create|role-edit|role-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:role-create'], ['only' => ['create', 'store', 'show']]);
        $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
    }


    public function index()
    {

        $roles = Role::all();
        return view($this->viewPath . 'index')->with(['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        $classes = ['user', 'role'];
        $backedClass = (new GlobalServices())
            ->getAllModal();
        $classes = array_merge($classes, $backedClass);
        return view($this->viewPath . 'create', compact('classes'));
    }

    public function store()
    {
//        $attributes = $request->validated();
//        try {
//            DB::beginTransaction();
//            $this->repository->create($attributes);
//            DB::commit();
//            return (new SuccessResponse($this->model, $request))->responseOk();
//        } catch (\Exception $exception) {
//            DB::rollBack();
//            return (new ErrorResponse($this->model, $request, $exception))->responseError();
//        }

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


    public function update(Request $request, int $id)
    {
        //
    }

    public function destroy(Request $request, $id)
    {
//        try {
//            DB::beginTransaction();
//            $this->repository->delete($id);
//            DB::commit();
//            return (new SuccessResponse($this->model, $request, 'delete'))->responseOk();
//        } catch (\Exception $exception) {
//            DB::rollBack();
//            return (new ErrorResponse($this->model, $request, $exception, 'delete'))->responseError();
//        }
    }


}
