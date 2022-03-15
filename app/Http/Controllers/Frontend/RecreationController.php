<?php

namespace App\Http\Controllers\Frontend;

use App\Services\Backend\RecreationService;

class RecreationController extends FrontendController
{
    /**
     * Module recreation
     */
    private $recreationService;

    public function __construct(RecreationService $recreationService)
    {
        parent::__construct();

        $this->recreationService = $recreationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //     self::$data['heading'] = __('messages.module') . ' ' . __('messages.list');
        self::$data['results'] = $this->recreationService->getAll();

        return view("frontend.recreation", self::$data);
    }
}
