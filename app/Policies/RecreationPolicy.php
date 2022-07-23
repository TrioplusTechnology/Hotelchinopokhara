<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecreationPolicy extends BasePolicy
{
    use HandlesAuthorization;

    protected $module = 'recreation';

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
