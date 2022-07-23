<?php

namespace App\Services\Backend\Settings;

use App\Repositories\Backend\Settings\RoleModulePermissionRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class RoleModulePermissionMappingService
{

    /**
     * @var $registrationRepository
     */
    protected $roleModulePermissionRepository;

    /**
     * Constructor
     */
    public function __construct(RoleModulePermissionRepository $roleModulePermissionRepository)
    {
        $this->roleModulePermissionRepository = $roleModulePermissionRepository;
    }

    /**
     * Stores users
     */
    public function store($data)
    {
        $dataToInsert = $this->prepareDataForMapping($data);
        $result = $this->roleModulePermissionRepository->insert($dataToInsert);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'bar']), 501);

        return $result;
    }

    /**
     * Gets all module list
     */
    public function getAll()
    {
        return $this->roleRepository->getAll();
    }

    /**
     * Updates about us
     */
    public function update($data, $roleId, $moduleId)
    {
        DB::beginTransaction();
        try {
            $dataToInsert = $this->prepareDataForMapping($data);

            $this->roleModulePermissionRepository->deleteMappingData($roleId, $moduleId);
            $result = $this->roleModulePermissionRepository->insert($dataToInsert);

            return $result;
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'role']), 501);
        }
    }

    /**
     * Deletes data
     */
    public function destroy($roleId, $moduleId)
    {
        $result = $this->roleModulePermissionRepository->deleteMappingData($roleId, $moduleId);

        if (!$result) throw new Exception(__('messages.error.failed_to_delete', ['RECORD' => 'role']), 422);
        return $result;
    }

    public function prepareDataForMapping($data)
    {
        $dataToInsert = [];
        foreach ($data['permission'] as $mapping) {
            $stack = [
                "role_id" => $data['role'],
                "module_id" => $data['module'],
                "permission_id" => $mapping
            ];

            array_push($dataToInsert, $stack);
        }

        return $dataToInsert;
    }
}
