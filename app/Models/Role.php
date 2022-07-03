<?php

namespace App\Models;

use App\Traits\CreatedUpdatedTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory,
        CreatedUpdatedTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'code',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * The permissions that belong to the user.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, "module_permission_role", "role_id", "permission_id");
    }

    /**
     * The permissions that belong to the user.
     */
    public function modules()
    {
        return $this->belongsToMany(Module::class, "module_permission_role", "role_id", "module_id");
    }
}
