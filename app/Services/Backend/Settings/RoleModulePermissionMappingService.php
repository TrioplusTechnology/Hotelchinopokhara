<?php

namespace App\Services\Backend\Settings;

use App\Repositories\Backend\Settings\RoleModulePermissionRepository;
use Exception;

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
     * Get data by id.
     */
    public function getRoleById($id)
    {
        $result = $this->roleRepository->getById($id);

        if (empty($result)) {
            throw new Exception(__('messages.error.not_found', ['RECORD' => 'role']), 404);
        }

        return $result;
    }

    /**
     * Updates about us
     */
    public function update($data, $id)
    {
        $result = $this->roleRepository->update($data, $id);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'role']), 501);

        return $result;
    }

    /**
     * Deletes data
     */
    public function destroy($id)
    {
        $result = $this->roleRepository->destroy($id);

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
