<?php

namespace App\Services\Backend;

use App\Repositories\Backend\RecreationRepository;
use Exception;

class RecreationService
{

    /**
     * @var $registrationRepository
     */
    protected $recreationRepository;

    /**
     * Constructor
     */
    public function __construct(RecreationRepository $recreationRepository)
    {
        $this->recreationRepository = $recreationRepository;
    }

    /**
     * Stores users
     */
    public function store($data, $request)
    {
        if ($request->file('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads/recreation', $fileName, 'public');
            $data['image'] = $filePath;
        }

        $result = $this->recreationRepository->store($data);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'user']), 501);

        return $result;
    }

    /**
     * Gets all module list
     */
    public function getAll()
    {
        return $this->recreationRepository->getAll();
    }

    /**
     * Get data by id.
     */
    public function getById($id)
    {
        $result = $this->recreationRepository->getById($id);

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
            $filePath = $request->file('image')->storeAs('uploads/recreation', $fileName, 'public');
            $data['image'] = $filePath;
        }

        $result = $this->recreationRepository->update($data, $id);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'module']), 501);

        return $result;
    }

    /**
     * Deletes data
     */
    public function destroy($id)
    {
        $result = $this->recreationRepository->destroy($id);

        if (!$result) throw new Exception(__('messages.error.failed_to_delete', ['RECORD' => 'module']), 422);
        return $result;
    }
}
