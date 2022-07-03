<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\BookingRequest;
use App\Services\Backend\Room\RoomService;
use App\Services\Backend\Room\RoomTypeService;
use App\Services\Frontend\BookingService;
use Exception;
use Illuminate\Http\Request;

class BookingController extends FrontendController
{
    /**
     * Module Service
     */
    private $roomTypeService;
    private $bookingService;

    public function __construct(RoomTypeService $roomTypeService, BookingService $bookingService)
    {
        parent::__construct();

        $this->roomTypeService = $roomTypeService;
        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['rooms'] = $this->roomTypeService->getAll();
        //     self::$data['heading'] = __('messages.module') . ' ' . __('messages.list');

        return view("frontend.book", self::$data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function book(BookingRequest $request)
    {
        try {
            $validated = $request->validated();
            $this->bookingService->book($validated);
            return redirect()->back()->with('success', __('messages.success.save', ['RECORD' => 'Booking']));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
