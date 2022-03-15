<?php

namespace App\Repositories\Backend\Event;

use App\Models\Event\Event;
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
}
