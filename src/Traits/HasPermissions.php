<?php

namespace Valiria\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Valiria\Models\Permission;
use Valiria\Models\Role;

trait HasPermissions
{
    use HasRoles;
    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * @param  Permission $permission
     * @return bool
     */
    public function hasPermission(Permission $permission): bool
    {
        return $this->permissions->contains($permission);
    }

    /**
     * @param  Permission $permission
     * @return bool
     */
    public function existPermission(Permission $permission): bool
    {
        return $this->roles
            ->filter(function (Role $role) use ($permission) {
                return $role->hasPermission($permission);
            })
            ->isNotEmpty();
    }
}
