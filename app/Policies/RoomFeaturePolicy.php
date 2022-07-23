<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomFeaturePolicy extends BasePolicy
{
    use HandlesAuthorization;

    protected $module = "room-feature";

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
