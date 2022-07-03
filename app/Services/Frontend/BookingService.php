<?php

namespace App\Services\Frontend;

use App\Repositories\Frontend\BookingRepository;
use Exception;

class BookingService
{

    /**
     * @var $registrationRepository
     */
    protected $bookingRepository;

    /**
     * Constructor
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * Stores users
     */
    public function book($data)
    {
        $data['status'] = 'booked';
        $result = $this->bookingRepository->store($data);

        if (!$result) throw new Exception(__('messages.error.failed_to_save', ['RECORD' => 'Booking record']), 501);

        return $result;
    }

    /**
     * Gets all booking list
     */
    public function getAll()
    {
        return $this->bookingRepository->getAll();
    }
}
