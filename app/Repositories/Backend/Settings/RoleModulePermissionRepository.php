<?php

namespace App\Repositories\Backend\Settings;

use App\Models\Role;
use App\Models\RoleModulePermissionMapping;
use App\Repositories\BaseRepository;

class RoleModulePermissionRepository extends BaseRepository
{

    /**
     * Constructor
     */
    public function __construct(RoleModulePermissionMapping $model)
    {
        parent::__construct($model);
    }
}
