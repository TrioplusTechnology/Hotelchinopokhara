<?php

namespace App\Repositories\Backend\Settings;

use App\Models\Role;
use App\Models\RoleModulePermissionMapping;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class RoleModulePermissionRepository extends BaseRepository
{

    /**
     * Constructor
     */
    public function __construct(RoleModulePermissionMapping $model)
    {
        parent::__construct($model);
    }

    public function deleteMappingData($roleId, $moduleId)
    {
        return DB::table('module_permission_role')
            ->where('role_id', '=', $roleId)
            ->where(
                'module_id',
                '=',
                $moduleId
            )->delete();
    }
}
