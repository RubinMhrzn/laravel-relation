<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showAdminLoginForm()
    {
        return view('admin.login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, $request->get('remember')])) {
            return redirect()->to('admin.dashboard');
        }
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
}
