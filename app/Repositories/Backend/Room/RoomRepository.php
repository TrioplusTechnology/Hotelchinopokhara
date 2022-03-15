<?php

namespace App\Repositories\Backend\Room;

use App\Models\Room\Room;
use App\Repositories\BaseRepository;

class RoomRepository extends BaseRepository
{
    /**
     * @var model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(Room $model)
    {
        parent::__construct($model);
    }
}
