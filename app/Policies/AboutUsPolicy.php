<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AboutUsPolicy extends BasePolicy
{
    use HandlesAuthorization;

    protected $module = 'about-us';

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
