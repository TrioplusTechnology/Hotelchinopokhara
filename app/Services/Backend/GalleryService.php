<?php

namespace App\Services\Backend;

use App\Repositories\Backend\Gallery\GalleryImageRepository;
use App\Repositories\Backend\Gallery\GalleryRepository;
use Exception;

class GalleryService
{

    /**
     * @var $registrationRepository
     */
    protected $galleryRepository;

    /**
     * @var $registrationRepository
     */
    protected $galleryImageRepository;

    /**
     * Constructor
     */
    public function __construct(GalleryRepository $galleryRepository, GalleryImageRepository $galleryImageRepository)
    {
        $this->galleryRepository = $galleryRepository;
        $this->galleryImageRepository = $galleryImageRepository;
    }

    /**
     * Stores users
     */
    public function store($data)
    {
        $result = $this->galleryRepository->store($data);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'gallery']), 501);

        return $result;
    }

    /**
     * Gets all module list
     */
    public function getAll()
    {
        return $this->galleryRepository->getAll();
    }

    /**
     * Get data by id.
     */
    public function getById($id)
    {
        $result = $this->galleryRepository->getById($id);

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
        $result = $this->galleryRepository->update($data, $id);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'gallery']), 501);

        return $result;
    }

    /**
     * Deletes data
     */
    public function destroy($id)
    {
        $result = $this->galleryRepository->destroy($id);

        if (!$result) throw new Exception(__('messages.error.failed_to_delete', ['RECORD' => 'module']), 422);
        return $result;
    }

    public function storeFile($request)
    {
        $files = $request->file('image');
        $dataToInsert = [];
        foreach ($files as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/gallerys', $fileName, 'public');
            $fileSize = $file->getSize();

            array_push($dataToInsert, [
                'gallery_id' => $request->id,
                'front_show' => false,
                'file_path' => $filePath,
                'size' => $fileSize,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ]);
        }

        $result = $this->galleryImageRepository->storeFile($dataToInsert);

        if (!$result) {
            throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'image']), 422);
        }

        return $result;
    }

    public function getGalleryImages($id)
    {
        $where = ["gallery_id" => $id];
        return $this->galleryImageRepository->findAllWhere($where);
    }

    public function deleteImage($request, $id)
    {
        if (file_exists(public_path('storage/' . $request->file))) {
            @unlink(public_path('storage/' . $request->file));
        }
        return $this->galleryImageRepository->destroy($id);
    }
}
