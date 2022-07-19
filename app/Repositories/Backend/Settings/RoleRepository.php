<?php

namespace App\Repositories\Backend\Settings;

use App\Models\Role;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class RoleRepository extends BaseRepository
{

    /**
     * Constructor
     */
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function getAllRoleModulePermissionData()
    {
        $query = "select
                    role.id as role_id,
                    role.name as role_name,
                    module.id as module_id,
                    module.name as module_name,
                    JSON_ARRAYAGG(
                        json_object(
                            'id', permission.id,
                            'name', permission.name
                            )
                    ) as permissions
                    from roles as role
                inner join module_permission_role mapping on role.id = mapping.role_id
                inner join modules as module on mapping.module_id = module.id
                inner join permissions permission on mapping.permission_id = permission.id
                group by module.id, module.name, role.id, role.name";

        return DB::select($query);
    }

    public function getRoleModulePermissionMappingByIds($roleId, $moduleId)
    {
        $query = "select
                    role.id as role_id,
                    role.name as role_name,
                    module.id as module_id,
                    module.name as module_name,
                    JSON_ARRAYAGG(
                        json_object(
                            'id', permission.id,
                            'name', permission.name
                            )
                    ) as permissions
                    from roles as role
                inner join module_permission_role mapping on role.id = mapping.role_id
                inner join modules as module on mapping.module_id = module.id
                inner join permissions permission on mapping.permission_id = permission.id
                where role.id = ? and module.id = ?
                group by module.id, module.name, role.id, role.name";

        return  collect(DB::select($query, [$roleId, $moduleId]))->first();
    }
}
