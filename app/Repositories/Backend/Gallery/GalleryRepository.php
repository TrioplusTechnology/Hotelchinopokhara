<?php

namespace App\Repositories\Backend\Gallery;

use App\Models\Gallery\Gallery;
use App\Repositories\BaseRepository;

class GalleryRepository extends BaseRepository
{
    /**
     * @var model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(Gallery $model)
    {
        parent::__construct($model);
    }
}
