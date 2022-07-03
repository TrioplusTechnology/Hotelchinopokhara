<?php

namespace App\Repositories\Frontend;

use App\Models\Booking;
use App\Repositories\BaseRepository;

class BookingRepository extends BaseRepository
{

    /**
     * Constructor
     */
    public function __construct(Booking $model)
    {
        parent::__construct($model);
    }
}
