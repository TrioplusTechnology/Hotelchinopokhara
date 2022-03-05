<?php

namespace App\Repositories\Backend;

use App\Models\Service;
use App\Repositories\BaseRepository;

class ServiceRepository extends BaseRepository
{
    /**
     * @var model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }
}
