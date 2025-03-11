<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function showAdminLoginForm()
    {
        return view('admin.login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, false])) {
            return redirect()->to('admin.dashboard');
        }

        return back()->withInput($request->only('username'));
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
}
