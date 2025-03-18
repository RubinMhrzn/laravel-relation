<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (!Auth::guard('writer')->check()) {
            return redirect()->route('writer.login');
        }
        return view('writer.dashboard');
    }
}
