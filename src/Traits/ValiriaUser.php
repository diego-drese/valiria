<?php

namespace Valiria\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Hash;
use Valiria\Models\Permission;
use Valiria\Models\Role;

trait ValiriaUser
{
    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = Hash::make($password);
        }
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'role_user',
            'user_id',
            'role_id'
        );
    }

    /**
     * @param  Role $role
     * @return bool
     */
    public function hasRole(Role $role): bool
    {
        return $this->roles->contains($role);
    }

    /**
     * @param  Permission $permission
     * @return bool
     */
    public function hasPermission(Permission $permission): bool
    {
        return $this->roles
            ->filter(function (Role $role) use ($permission) {
                return $role->hasPermission($permission);
            })->isNotEmpty();
    }

    /**
     * @param array $attributes
     * @return Builder|Model
     */
    public static function create(array $attributes = []) {
        $roles = $attributes['roles'] ?? null;
        if ($roles) {
            unset($attributes['roles']);
        }
        $model = static::query()->create($attributes);
        if ($roles) {
            $model->roles()->attach($roles);
        }
        return $model;
    }

    /**
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = []) {
        $roles = $attributes['roles'] ?? null;
        if ($roles) {
            unset($attributes['roles']);
        }
        $updated = parent::update($attributes, $options);
        if ($updated && $roles) {
            $this->roles()->sync($roles);
        }

        return $updated;
    }
}
