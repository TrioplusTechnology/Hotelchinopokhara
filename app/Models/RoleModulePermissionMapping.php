<?php

namespace App\Models;

use App\Traits\CreatedUpdatedTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModulePermissionMapping extends Model
{
    use HasFactory,
        CreatedUpdatedTrait;

    protected $table = 'module_permission_role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'module_id',
        'role_id',
        'permission_id'
    ];
}
