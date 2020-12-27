<?php


namespace Modules\Backend\Repositories;


use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRepository extends Repository
{


    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getUsersByPermissionGuard($permission, $guard)
    {
        return Permission::findByName($permission, $guard)->users;
    }

    public function create(array $attributes)
    {
        $attributes['password'] = $this->encryptPassword($attributes['password_generated']);
        return $this->model->create($attributes);
    }

    public function encryptPassword($password_generated)
    {
        return Hash::make($password_generated);
    }

    public function selectUsers($users)
    {
        $selectUsers = [];
        foreach ($users as $user) {
            $selectUsers[$user->id] = $user->name;
        }
        return $selectUsers;
    }

    public function selectRoles()
    {
        return DB::table('roles')->pluck('name', 'id')->toArray();
    }

    public function findRoleById($id)
    {
        return Role::findById($id);
    }
}
