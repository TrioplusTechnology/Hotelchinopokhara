<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as FacadesRoute;
use phpDocumentor\Reflection\Types\Boolean;

abstract class BasePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin()) return true;
    }

    public function canViewList(User $user)
    {
        return $user->checkPermission($user, $this->module, __FUNCTION__);
    }

    public function canCreate(User $user)
    {
        return $user->checkPermission($user, $this->module, __FUNCTION__);
    }

    public function canUpdate(User $user)
    {
        return $user->checkPermission($user, $this->module, __FUNCTION__);
    }

    public function canDelete(User $user)
    {
        return $user->checkPermission($user, $this->module, __FUNCTION__);
    }

    public function canView(User $user)
    {
        return $user->checkPermission($user, $this->module, __FUNCTION__);
    }

    public function canApprove(User $user)
    {
        return $user->checkPermission($user, $this->module, __FUNCTION__);
    }
}
