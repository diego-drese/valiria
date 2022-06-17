<?php
namespace Valiria\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Valiria\Traits\HasPermissions;
use Valiria\Traits\HasRoles;

class Role extends Model
{
    use HasRoles, HasPermissions;
    protected $table = 'role';
    protected $guarded = ['id'];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
