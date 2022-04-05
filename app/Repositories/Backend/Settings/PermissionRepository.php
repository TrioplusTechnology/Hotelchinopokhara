<?php

namespace App\Repositories\Backend\Settings;

use App\Models\Permission;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository
{

    /**
     * Constructor
     */
    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }
}
