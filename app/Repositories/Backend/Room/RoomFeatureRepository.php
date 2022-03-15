<?php

namespace App\Repositories\Backend\Room;

use App\Models\Room\RoomFeature;
use App\Repositories\BaseRepository;

class RoomFeatureRepository extends BaseRepository
{
    /**
     * @var model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(RoomFeature $model)
    {
        parent::__construct($model);
    }
}
