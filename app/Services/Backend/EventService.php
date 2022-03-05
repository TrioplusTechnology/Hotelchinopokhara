<?php

namespace App\Services\Backend;

use App\Repositories\Backend\EventRepository;
use Exception;

class EventService
{

    /**
     * @var $registrationRepository
     */
    protected $eventRepository;

    /**
     * Constructor
     */
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * Stores users
     */
    public function store($data)
    {
        $result = $this->eventRepository->store($data);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'event']), 501);

        return $result;
    }

    /**
     * Gets all module list
     */
    public function getAll()
    {
        return $this->eventRepository->getAll();
    }

    /**
     * Get data by id.
     */
    public function getById($id)
    {
        $result = $this->eventRepository->getById($id);

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
            $filePath = $request->file('image')->storeAs('uploads/event', $fileName, 'public');
            $data['image'] = $filePath;
        }

        $result = $this->eventRepository->update($data, $id);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'module']), 501);

        return $result;
    }

    /**
     * Deletes data
     */
    public function destroy($id)
    {
        $result = $this->eventRepository->destroy($id);

        if (!$result) throw new Exception(__('messages.error.failed_to_delete', ['RECORD' => 'module']), 422);
        return $result;
    }

    public function storeFile($request)
    {
        $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
        $filePath = $request->file('image')->storeAs('uploads/events', $fileName, 'public');

        $dataToInsert = [
            'event_id' => $request->id,
            'font_show' => false,
            'file_path' => $filePath
        ];

        $result = $this->eventRepository->storeFile($dataToInsert);

        if (!$result) {
            throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'image']), 422);
        }

        return $result;
    }
}
