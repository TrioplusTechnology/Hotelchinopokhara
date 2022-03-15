<?php

namespace App\Http\Controllers\Frontend;

use App\Services\Backend\Room\RoomService;

class RoomController extends FrontendController
{
    /**
     * Module Service
     */
    private $roomService;

    public function __construct(RoomService $roomService)
    {
        parent::__construct();

        $this->roomService = $roomService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //     self::$data['heading'] = __('messages.module') . ' ' . __('messages.list');
        self::$data['results'] = $rooms = $this->roomService->getAll();

        return view("frontend.room", self::$data);
    }
}
