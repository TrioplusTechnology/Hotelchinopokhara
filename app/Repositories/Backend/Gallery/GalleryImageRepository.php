<?php

namespace App\Repositories\Backend\Gallery;

use App\Models\Gallery\GalleryImage;
use App\Repositories\BaseRepository;

class GalleryImageRepository extends BaseRepository
{
    /**
     * @var model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(GalleryImage $model)
    {
        parent::__construct($model);
    }

    public function storeFile($data)
    {
        return $this->model->insert($data);
    }
}
