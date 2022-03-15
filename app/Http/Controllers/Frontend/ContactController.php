<?php

namespace App\Http\Controllers\Frontend;

class ContactController extends FrontendController
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
        return view("frontend.contact", self::$data);
    }
}
