<?php

namespace App\Repositories\Backend\Bar;

use App\Models\Bar\BarImage;
use App\Repositories\BaseRepository;

class BarImageRepository extends BaseRepository
{
    /**
     * @var model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(BarImage $model)
    {
        parent::__construct($model);
    }

    public function storeFile($data)
    {
        return $this->model->insert($data);
    }
}
