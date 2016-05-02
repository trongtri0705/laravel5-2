<?php

namespace app\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        return view('admin.dashboard.index');
    }
}
