<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, LogsActivity, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_super'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isSuper(): bool
    {
        return $this->getAttribute('is_super') == 1;
    }

    public function assignRole($roles, string $guard = null): User
    {
        $roles = is_string($roles) ? [$roles] : $roles;
        $guard = $guard ?: $this->getDefaultGuardName();
        $roles = collect($roles)
            ->flatten()
            ->map(function ($role) use ($guard) {
                $role = Role::findByName($role, $guard);
                return $this->getStoredRole($role);
            })
            ->each(function ($role) {
                $this->ensureModelSharesGuard($role);
            })
            ->all();

        $this->roles()->saveMany($roles);

        $this->forgetCachedPermissions();

        return $this;
    }

    protected function getStoredRole($role): Role
    {
        $roleClass = $this->getRoleClass();

        if (is_numeric($role)) {
            return $roleClass->findById($role, $this->getDefaultGuardName());
        }

        if (is_string($role)) {
            return $roleClass->findByName($role, $this->getDefaultGuardName());
        }

        if (is_a($role, get_class($roleClass))) {
            return $role;
        }

        return $role;
    }

    public function removeRole($role)
    {
        if (is_a($role, get_class($this->getRoleClass()))) {
            $this->roles()->detach($this->getStoredRole($role));
        } else {
            $this->roles()->detach($this->getStoredRole($role));
        }
        $this->load('roles');
    }

    public function hasAnyPermission(...$permissions): bool
    {
        if (is_array($permissions[0])) {
            $permissions = $permissions[0];
        }
        foreach ($permissions as $permission) {
            if ($this->can($permission)) {
                return true;
            }
        }

        return false;
    }
}
