<?php

namespace App\Services\Backend;

use App\Repositories\Backend\Bar\BarImageRepository;
use App\Repositories\Backend\Bar\BarRepository;
use Exception;

class BarService
{

    /**
     * @var $registrationRepository
     */
    protected $barRepository;

    /**
     * @var $registrationRepository
     */
    protected $barImageRepository;

    /**
     * Constructor
     */
    public function __construct(BarRepository $barRepository, BarImageRepository $barImageRepository)
    {
        $this->barRepository = $barRepository;
        $this->barImageRepository = $barImageRepository;
    }

    /**
     * Stores users
     */
    public function store($data)
    {
        $result = $this->barRepository->store($data);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'bar']), 501);

        return $result;
    }

    /**
     * Gets all module list
     */
    public function getAll()
    {
        return $this->barRepository->getAll();
    }

    /**
     * Get data by id.
     */
    public function getById($id)
    {
        $result = $this->barRepository->getById($id);

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
        $result = $this->barRepository->update($data, $id);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'bar']), 501);

        return $result;
    }

    /**
     * Deletes data
     */
    public function destroy($id)
    {
        $result = $this->barRepository->destroy($id);

        if (!$result) throw new Exception(__('messages.error.failed_to_delete', ['RECORD' => 'module']), 422);
        return $result;
    }

    public function storeFile($request)
    {
        $files = $request->file('image');
        $dataToInsert = [];
        foreach ($files as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/bars', $fileName, 'public');

            array_push($dataToInsert, [
                'bar_id' => $request->id,
                'front_show' => false,
                'file_path' => $filePath,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ]);
        }

        $result = $this->barImageRepository->storeFile($dataToInsert);

        if (!$result) {
            throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'image']), 422);
        }

        return $result;
    }

    public function getBarImages($id)
    {
        $where = ["bar_id" => $id];
        return $this->barImageRepository->findAllWhere($where);
    }

    public function deleteImage($request, $id)
    {
        if (file_exists(public_path('storage/' . $request->file))) {
            @unlink(public_path('storage/' . $request->file));
        }
        return $this->barImageRepository->destroy($id);
    }
}
