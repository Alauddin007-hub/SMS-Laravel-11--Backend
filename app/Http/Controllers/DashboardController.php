<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function superadmin()
    {
        return view('backend.dashboard.superadmin_dashboard');
    }
    public function admin()
    {
        return view('backend.dashboard.admin_dashboard');
    }
    public function user()
    {
        return view('backend.dashboard.user_dashboard');
    }
}
