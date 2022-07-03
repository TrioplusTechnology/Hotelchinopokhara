<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\BookingService;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class BookingController extends BackendController
{
    /**
     * Common traits
     */
    use CommonTrait;

    /**
     * Module Service
     */
    private $bookingService;

    public function __construct(BookingService $bookingService)
    {
        parent::__construct();

        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['heading'] = __('messages.booking') . ' ' . __('messages.list');
        self::$data['lists'] =  $lists = $this->bookingService->getAll();

        return view("backend.booking", self::$data);
    }

    public function getBookingDetailById()
    {
    }

    public function changeBookingStatus()
    {
    }
}
