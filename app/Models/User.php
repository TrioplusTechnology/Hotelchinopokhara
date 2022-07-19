<?php

namespace App\Models;

use App\Traits\CreatedUpdatedTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CreatedUpdatedTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'middle_name',
        'last_name',
        'phone',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, "role_user", "user_id", "role_id");
    }

    public function checkPermission(User $user, $module, $permission)
    {
        $sql = "select users.id
                    from users
                inner join role_user role on users.id = role.user_id
                inner join module_permission_role mpr on role.role_id = mpr.role_id
                inner join modules as module on module.id = mpr.module_id
                inner join permissions as permission on permission.id = mpr.permission_id
                where users.id = ? and module.code = ? and permission.code = ?";

        $result = DB::select($sql, [$user->id, $module, $permission]);

        return empty($result) ? false : true;
    }

    public function isSuperAdmin()
    {
        $userRoles = auth()->user()->roles;
        $userRolesInArray = $this->getUserRolesInArray($userRoles);

        return in_array('super-admin', $userRolesInArray);
    }

    public function getUserRolesInArray($roles)
    {
        $roleArray = [];
        foreach ($roles as $role) {
            array_push($roleArray, $role->code);
        }
        return $roleArray;
    }
}
