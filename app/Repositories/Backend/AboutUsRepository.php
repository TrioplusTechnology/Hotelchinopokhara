<?php

namespace App\Repositories\Backend;

use App\Models\About;
use App\Repositories\BaseRepository;
use Exception;

class AboutUsRepository extends BaseRepository
{

    /**
     * Constructor
     */
    public function __construct(About $model)
    {
        parent::__construct($model);
    }
}
