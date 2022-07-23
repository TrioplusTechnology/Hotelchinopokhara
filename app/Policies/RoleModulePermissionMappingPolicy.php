<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoleModulePermissionMappingPolicy extends BasePolicy
{
    use HandlesAuthorization;
    protected $module = 'role-module-permission-mapping';

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
}
