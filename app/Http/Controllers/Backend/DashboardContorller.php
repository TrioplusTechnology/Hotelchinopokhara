<?php

namespace App\Http\Controllers\Backend;

class DashboardContorller extends BackendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard()
    {
        self::$data['heading'] = __('messages.dashboard');
        return view('/backend/dashboard', self::$data);
    }
}
