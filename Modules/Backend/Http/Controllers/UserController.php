<?php

namespace Modules\Backend\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Auth\Repositories\RoleRepository;
use Modules\Backend\Http\Requests\UserRequest;
use Modules\Backend\Http\Response\ErrorResponse;
use Modules\Backend\Http\Response\SuccessResponse;
use Modules\Backend\Repositories\UserRepository;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    protected $viewPath = 'backend::users.';
    protected $guard = 'admin';
    protected $modal = 'modal-user';
    protected $baseRoute = 'admin.users.';

    protected $repository;
    /**
     * @var User
     */
    private $model;
    /**
     * @var Role
     */
    private $role;

    public function __construct()
    {
//        $this->middleware('auth:admin');
        $this->middleware(['permission:user-view|user-create|user-edit|user-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:user-create'], ['only' => ['create', 'store', 'show']]);
        $this->middleware(['permission:user-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:user-delete'], ['only' => ['destroy']]);
        $this->model = new User();
        $this->repository = new UserRepository($this->model);
        $this->role = new Role();
    }

    public function index()
    {
        $button = 'Save';
        $users = $this->repository->getAll();
        $roles = $this->repository->selectRoles();
        if (!Auth::user()->isSuper())
            $users = $users->where('super', false)
                ->sortByDesc('created_at');
        return view($this->viewPath . 'index', compact('users', 'roles', 'button'))
            ->with(['modal' => $this->modal]);
    }

    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            $password_generated = Str::random(10);
            $request->request->add(['password_generated' => $password_generated]);
            $input = $request->validated();
            $user = $this->repository->create($input);
            $user->givePermissionTo('admin-permission');
            $user->assignRole($this->repository->findRoleById($input['roles'])->name, 'admin');
            DB::commit();
            return (new SuccessResponse($this->model, $request))->responseOk();
        } catch (Exception $exception) {
            DB::rollBack();
            return (new ErrorResponse($this->model, $request, $exception))->responseError();

        }
    }

    public function show($id)
    {
        $user = $this->repository->getById($id);
        $user['roles'] = $user->getRoleNames()->first();
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'is_active' => $user->is_active,
            'is_super' => $user->is_super
        ]);
    }

    public function update(UserRequest $request, $id)
    {

        try {
            DB::beginTransaction();
            $input = $request->validated();
            $user = $this->repository->getById($id);
            if (!isset($input['is_super']))
                $input['is_super'] = false;
            $user->update($input);
            $roles = $user->roles->where('guard_name', $this->guard);
            foreach ($roles as $role) {
                $user->removeRole($role);
            }
            $role = $this->repository->findRoleById($input['roles']);
            $user->assignRole($role->name, $this->guard);
            DB::commit();
            return (new SuccessResponse($this->model, $request, 'updated'))->responseOk();
        } catch (Exception $exception) {
            DB::rollBack();
            return (new ErrorResponse($this->model, $request, $exception))->responseError();
        }

    }

//    public function destroy($id)
//    {
//        try {
//            DB::beginTransaction();
//            $user = $this->repository->getById($id);
//            $roles = $user->roles;
//            $applicationPermission = User::applicationPermissions();
//            $applicationPermission = array_diff($applicationPermission, [$this->routePrefix . '-permission']);
//            if (!empty($applicationPermission)) {
//                if ($user->hasAnyPermission($applicationPermission)) {
//                    $this->repository->deleteFomApplication($id, $roles, $this->routePrefix);
//                    DB::commit();
//                    return redirect()->route($this->routePrefix . '.users.index')
//                        ->with('success', 'User deleted successfully');
//                } else {
//                    $this->repository->delete($id);
//                    DB::commit();
//                    return redirect()->route($this->routePrefix . '.users.index')
//                        ->with('success', 'User deleted successfully');
//                }
//            } else {
//                $this->repository->delete($id);
//                DB::commit();
//                return redirect()->route($this->routePrefix . '.users.index')
//                    ->with('success', 'User deleted successfully');
//            }
//        } catch (\PDOException $ex) {
//            DB::rollBack();
//            try {
//                $user->status = false;
//                $user->save();
//                //$this->repository->deleteFomApplication($id, $roles, $this->routePrefix);
//                DB::commit();
//                return redirect()->route($this->routePrefix . '.users.index')
//                    ->with('warning', 'The user cannot be deleted. Thus, the user has been inactivated.');
//            } catch (\Exception $ex) {
//                DB::rollBack();
//                return redirect()->route($this->routePrefix . '.users.index')
//                    ->with('failed', 'User cannot be deleted.');
//            }
//        } catch (\Exception $ex) {
//            DB::rollBack();
//            return redirect()->route($this->routePrefix . '.users.index')
//                ->with('failed', 'User cannot be deleted.');
//        }
//    }
//
//
//    public function profile()
//    {
//        $user = $this->repository->getById(Auth::user()->id);
//        $locationRepo = new LocationRepository((new Location()));
//        $selectDepartments = $this->department->selectDepartments();
//        $selectLocations = $locationRepo->selectLocations();
//        return view('auth::users.profile', compact('user', 'selectDepartments', 'selectLocations'));
//    }
//
//    public function updateProfile(UpdateProfileRequest $request, $id)
//    {
//        $input = $request->all();
//        $user = $this->repository->getById($id);
//        $user->update($input);
//        return redirect()->route($this->routePrefix . '.profile')
//            ->with('success', 'Profile updated successfully');
//    }
//
//    public function updateAvatar(Request $request)
//    {
//        if ($request->hasFile('avatar')) {
//            $avatar = $request->file('avatar');
//            $filename = time() . '.' . $avatar->getClientOriginalExtension();
//            $img = Image::make($avatar->getRealPath());
//            $img->stream();
//            Storage::disk('local')->put('/public/avatars/' . $filename, $img, 'public');
//            $user = Auth::user();
//            Storage::delete('/public/avatars/' . $user->avatar);
//            $user->avatar = $filename;
//            $user->save();
//            return redirect()->route($this->routePrefix . '.profile')
//                ->with('success', 'Profile image updated successfully');
//        }
//    }
//

}
