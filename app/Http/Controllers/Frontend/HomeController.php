<?php

namespace App\Http\Controllers\Frontend;

class HomeController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // self::$data['heading'] = __('messages.module') . ' ' . __('messages.list');
        // self::$data['addUrl'] = route('admin.setting.module.create');
        // self::$data['modules'] = $this->moduleService->getAllModule();

        return view("frontend.home", self::$data);
    }
}
