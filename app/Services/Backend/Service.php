<?php

namespace App\Services\Backend;

use App\Repositories\Backend\ServiceRepository;
use Exception;

class Service
{

    /**
     * @var $registrationRepository
     */
    protected $serviceRepository;

    /**
     * Constructor
     */
    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * Stores users
     */
    public function store($data, $request)
    {
        if ($request->file('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads/service', $fileName, 'public');
            $data['image'] = $filePath;
        }

        $result = $this->serviceRepository->store($data);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'user']), 501);

        return $result;
    }

    /**
     * Gets all module list
     */
    public function getAll()
    {
        return $this->serviceRepository->getAll();
    }

    /**
     * Get data by id.
     */
    public function getById($id)
    {
        $result = $this->serviceRepository->getById($id);

        if (empty($result)) {
            throw new Exception(__('messages.error.not_found', ['RECORD' => 'module']), 404);
        }

        return $result;
    }

    /**
     * Updates about us
     */
    public function update($data, $request, $id)
    {
        if ($request->file('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads/service', $fileName, 'public');
            $data['image'] = $filePath;
        }

        $result = $this->serviceRepository->update($data, $id);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'module']), 501);

        return $result;
    }

    /**
     * Deletes data
     */
    public function destroy($id)
    {
        $result = $this->serviceRepository->destroy($id);

        if (!$result) throw new Exception(__('messages.error.failed_to_delete', ['RECORD' => 'module']), 422);
        return $result;
    }
}
