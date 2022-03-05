<?php

namespace App\Repositories\Backend;

use App\Models\Recreation;
use App\Repositories\BaseRepository;
use Exception;

class RecreationRepository extends BaseRepository
{
    /**
     * @var model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(Recreation $model)
    {
        parent::__construct($model);
    }
}
