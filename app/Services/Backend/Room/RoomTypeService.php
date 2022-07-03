<?php

namespace App\Services\Backend\Room;

use App\Repositories\Backend\Room\RoomImageRepository;
use App\Repositories\Backend\Room\RoomTypeRepository;
use Exception;

class RoomTypeService
{

    /**
     * @var $registrationRepository
     */
    protected $roomTypeRepository;

    /**
     * @var $registrationRepository
     */
    protected $roomImageRepository;

    /**
     * Constructor
     */
    public function __construct(RoomTypeRepository $roomTypeRepository, RoomImageRepository $roomImageRepository)
    {
        $this->roomTypeRepository = $roomTypeRepository;
        $this->roomImageRepository = $roomImageRepository;
    }

    /**
     * Stores users
     */
    public function store($data)
    {
        $result = $this->roomTypeRepository->store($data);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'Room']), 501);

        $pivotData = [];
        foreach ($data['features'] as $feature) {
            array_push($pivotData, ['room_id' => $result->id, 'room_feature_id' => (int)$feature]);
        }

        $result->features()->sync($pivotData);

        return $result;
    }

    /**
     * Gets all module list
     */
    public function getAll()
    {
        return $this->roomTypeRepository->getAll();
    }

    /**
     * Get data by id.
     */
    public function getById($id)
    {
        $result = $this->roomTypeRepository->getById($id);

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
        $pivotData = [];
        foreach ($data['features'] as $feature) {
            array_push($pivotData, ['room_id' => $id, 'room_feature_id' => (int)$feature]);
        }
        unset($data['features']);
        $result = $this->roomTypeRepository->update($data, $id);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'Room']), 501);


        $result->features()->sync($pivotData);

        return $result;
    }

    /**
     * Deletes data
     */
    public function destroy($id)
    {
        $result = $this->roomTypeRepository->destroy($id);

        if (!$result) throw new Exception(__('messages.error.failed_to_delete', ['RECORD' => 'module']), 422);
        return $result;
    }

    public function storeFile($request)
    {
        $files = $request->file('image');
        $dataToInsert = [];
        foreach ($files as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/Rooms', $fileName, 'public');
            $fileSize = $file->getSize();

            array_push($dataToInsert, [
                'Room_id' => $request->id,
                'front_show' => false,
                'file_path' => $filePath,
                'size' => $fileSize,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ]);
        }

        $result = $this->roomImageRepository->storeFile($dataToInsert);

        if (!$result) {
            throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'image']), 422);
        }

        return $result;
    }

    public function getRoomImages($id)
    {
        $where = ["Room_id" => $id];
        return $this->roomImageRepository->findAllWhere($where);
    }

    public function deleteImage($request, $id)
    {
        if (file_exists(public_path('storage/' . $request->file))) {
            @unlink(public_path('storage/' . $request->file));
        }
        return $this->roomImageRepository->destroy($id);
    }
}
