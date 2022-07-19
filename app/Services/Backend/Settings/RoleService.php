<?php

namespace App\Services\Backend\Settings;

use App\Repositories\Backend\Settings\RoleRepository;
use Exception;

class RoleService
{

    /**
     * @var $registrationRepository
     */
    protected $roleRepository;

    /**
     * Constructor
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Stores users
     */
    public function store($data)
    {
        $result = $this->roleRepository->store($data);

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

    public function getAllRoleModulePermissionData()
    {
        return $this->roleRepository->getAllRoleModulePermissionData();
    }

    public function getRoleModulePermissionMappingByIds($roleId, $moduleId)
    {
        return $this->roleRepository->getRoleModulePermissionMappingByIds($roleId, $moduleId);
    }
}
