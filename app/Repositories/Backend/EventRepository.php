<?php

namespace App\Repositories\Backend;

use App\Models\Event;
use App\Repositories\BaseRepository;

class EventRepository extends BaseRepository
{
    /**
     * @var model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(Event $model)
    {
        parent::__construct($model);
    }

    public function storeFile($data)
    {
        return $this->model->create($data);
    }
}
