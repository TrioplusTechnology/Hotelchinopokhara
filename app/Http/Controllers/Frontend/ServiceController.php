<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendController;
use App\Services\Backend\Service;

class ServiceController extends FrontendController
{
    /**
     * Module Service
     */
    private $service;

    public function __construct(Service $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //     self::$data['heading'] = __('messages.module') . ' ' . __('messages.list');
        self::$data['results'] = $this->service->getAll();

        return view("frontend.service", self::$data);
    }
}
