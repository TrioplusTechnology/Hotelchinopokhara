<?php

namespace App\Repositories\Backend\Settings;

use App\Models\Role;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository
{

    /**
     * Constructor
     */
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
