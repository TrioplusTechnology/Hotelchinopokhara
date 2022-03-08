<?php

namespace App\Services\Backend;

use App\Repositories\Backend\EventImageRepository;
use App\Repositories\Backend\EventRepository;
use Exception;
use Illuminate\Support\Facades\Storage;

class EventService
{

    /**
     * @var $registrationRepository
     */
    protected $eventRepository;

    /**
     * @var $registrationRepository
     */
    protected $eventImageRepository;

    /**
     * Constructor
     */
    public function __construct(EventRepository $eventRepository, EventImageRepository $eventImageRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->eventImageRepository = $eventImageRepository;
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
    public function update($data, $id)
    {
        $result = $this->eventRepository->update($data, $id);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'event']), 501);

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
        $files = $request->file('image');
        $dataToInsert = [];
        foreach ($files as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/events', $fileName, 'public');

            array_push($dataToInsert, [
                'event_id' => $request->id,
                'front_show' => false,
                'file_path' => $filePath,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ]);
        }

        $result = $this->eventImageRepository->storeFile($dataToInsert);

        if (!$result) {
            throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'image']), 422);
        }

        return $result;
    }

    public function getEventImages($id)
    {
        $where = ["event_id" => $id];
        return $this->eventImageRepository->findAllWhere($where);
    }

    public function deleteImage($request, $id)
    {
        if (file_exists(public_path('storage/' . $request->file))) {
            @unlink(public_path('storage/' . $request->file));
        }
        return $this->eventImageRepository->destroy($id);
    }
}
