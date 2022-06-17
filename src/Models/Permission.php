<?php

namespace Valiria\Models;

use Illuminate\Database\Eloquent\Model;
use Valiria\Traits\HasRoles;

class Permission extends Model
{
    use HasRoles;

    protected $table = 'permission';
    protected $guarded = ['id'];

    public static function getPermission($verb, $uri) {
        return self::where('verb', $verb)->where('uri', $uri)->first();
    }
}
