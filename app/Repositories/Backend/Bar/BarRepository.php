<?php

namespace App\Repositories\Backend\Bar;

use App\Models\Bar\Bar;
use App\Repositories\BaseRepository;

class BarRepository extends BaseRepository
{
    /**
     * @var model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(Bar $model)
    {
        parent::__construct($model);
    }
}
