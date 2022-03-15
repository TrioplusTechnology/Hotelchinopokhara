<?php

namespace App\Http\Controllers\Frontend;

use App\Services\Backend\BarService;

class BarController extends FrontendController
{
    /**
     * Module Service
     */
    private $barService;

    public function __construct(BarService $barService)
    {
        parent::__construct();

        $this->barService = $barService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::$data['results'] = $this->barService->getAll()->sortByDesc('id')->first();

        return view("frontend.bar", self::$data);
    }
}
