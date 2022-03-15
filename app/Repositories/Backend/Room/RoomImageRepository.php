<?php

namespace App\Repositories\Backend\Room;

use App\Models\Room\RoomImage;
use App\Repositories\BaseRepository;

class RoomImageRepository extends BaseRepository
{
    /**
     * @var model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(RoomImage $model)
    {
        parent::__construct($model);
    }

    public function storeFile($data)
    {
        return $this->model->insert($data);
    }
}
