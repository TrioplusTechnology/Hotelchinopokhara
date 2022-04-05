<?php

namespace App\Services\Backend\Settings;

use App\Repositories\Backend\Settings\PermissionRepository;
use Exception;

class PermissionService
{

    /**
     * @var $registrationRepository
     */
    protected $permissionRepository;

    /**
     * Constructor
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Stores users
     */
    public function store($request)
    {
        $result = $this->permissionRepository->store($request);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'user']), 501);

        return $result;
    }

    /**
     * Gets all permission list
     */
    public function getAll()
    {
        return $this->permissionRepository->getAll();
    }

    public function getById($id)
    {
        $result = $this->permissionRepository->getById($id);

        if (empty($result)) {
            throw new Exception(__('messages.error.not_found', ['RECORD' => 'permission']), 404);
        }

        return $result;
    }

    public function update($request, $id)
    {
        $result = $this->permissionRepository->update($request, $id);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'permission']), 501);

        return $result;
    }

    public function destroy($id)
    {
        $result = $this->permissionRepository->destroy($id);

        if (!$result) throw new Exception(__('messages.error.failed_to_delete', ['RECORD' => 'permission']), 422);
        return $result;
    }
}
