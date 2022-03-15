<?php

namespace App\Services\Backend\Room;

use App\Repositories\Backend\Room\RoomFeatureRepository;
use Exception;

class RoomFeatureService
{

    /**
     * @var $registrationRepository
     */
    protected $roomFeatureRepository;

    /**
     * @var $registrationRepository
     */
    protected $roomImageRepository;

    /**
     * Constructor
     */
    public function __construct(RoomFeatureRepository $roomFeatureRepository)
    {
        $this->roomFeatureRepository = $roomFeatureRepository;
    }

    /**
     * Stores users
     */
    public function store($data)
    {
        $result = $this->roomFeatureRepository->store($data);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'Room']), 501);

        return $result;
    }

    /**
     * Gets all module list
     */
    public function getAll()
    {
        return $this->roomFeatureRepository->getAll();
    }

    /**
     * Get data by id.
     */
    public function getById($id)
    {
        $result = $this->roomFeatureRepository->getById($id);

        if (empty($result)) {
            throw new Exception(__('messages.error.not_found', ['RECORD' => 'module']), 404);
        }

        return $result;
    }

    /**
     * Updates about us
     */
    public function update($data, $id)
    {
        $result = $this->roomFeatureRepository->update($data, $id);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'Room']), 501);

        return $result;
    }

    /**
     * Deletes data
     */
    public function destroy($id)
    {
        $result = $this->roomFeatureRepository->destroy($id);

        if (!$result) throw new Exception(__('messages.error.failed_to_delete', ['RECORD' => 'module']), 422);
        return $result;
    }
}
