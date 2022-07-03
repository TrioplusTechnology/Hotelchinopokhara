<?php

namespace App\Repositories\Backend\Room;

use App\Models\Room\RoomType;
use App\Repositories\BaseRepository;

class RoomTypeRepository extends BaseRepository
{
    /**
     * @var model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(RoomType $model)
    {
        parent::__construct($model);
    }
}
