<?php

namespace App\Http\Controllers\Frontend;

use App\Services\Backend\AboutUsService;;
class AboutUsController extends FrontendController
{
    /**
     * Module Service
     */
    private $aboutUsService;

    public function __construct(AboutUsService $aboutUsService)
    {
        parent::__construct();

        $this->aboutUsService = $aboutUsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //     self::$data['heading'] = __('messages.module') . ' ' . __('messages.list');
        self::$data['results'] = $this->aboutUsService->getAll();

        return view("frontend.about_us", self::$data);
    }
}
