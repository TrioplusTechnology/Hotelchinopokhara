<?php

namespace App\Repositories\Backend\Event;

use App\Models\Event\EventImage;
use App\Repositories\BaseRepository;

class EventImageRepository extends BaseRepository
{
    /**
     * @var model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(EventImage $model)
    {
        parent::__construct($model);
    }

    public function storeFile($data)
    {
        return $this->model->insert($data);
    }
}
