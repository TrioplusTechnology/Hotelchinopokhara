<?php

namespace App\Http\Controllers\Frontend;

use App\Services\Backend\EventService;

class EventController extends FrontendController
{
    /**
     * Module Service
     */
    private $eventService;

    public function __construct(EventService $eventService)
    {
        parent::__construct();

        $this->eventService = $eventService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['results'] = $results = $this->eventService->getAll()->sortByDesc('id')->first();

        return view("frontend.bar", self::$data);
    }
}
