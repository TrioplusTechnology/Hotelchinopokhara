<?php

namespace App\Services\Backend\Settings;

use App\Repositories\Backend\Settings\ModuleRepository;
use Exception;

class ModuleService
{

    /**
     * @var $registrationRepository
     */
    protected $moduleRepository;

    /**
     * Constructor
     */
    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    /**
     * Stores users
     */
    public function store($request)
    {
        $result = $this->moduleRepository->store($request);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'user']), 501);

        return $result;
    }

    /**
     * Gets all module list
     */
    public function getAllModule()
    {
        return $this->moduleRepository->getAllModule();
    }

    public function getModuleById($id)
    {
        $result = $this->moduleRepository->getModuleById($id);

        if (empty($result)) {
            throw new Exception(__('messages.error.not_found', ['RECORD' => 'module']), 404);
        }

        return $result;
    }

    public function update($request, $id)
    {
        $result = $this->moduleRepository->update($request, $id);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'module']), 501);

        return $result;
    }

    public function destroy($id)
    {
        $result = $this->moduleRepository->destroy($id);

        if (!$result) throw new Exception(__('messages.error.failed_to_delete', ['RECORD' => 'module']), 422);
        return $result;
    }
}
