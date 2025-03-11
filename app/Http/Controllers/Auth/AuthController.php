<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showWriterLoginForm()
    {
        return view('writer.login', ['url' => route('writer.login')]);
    }

    public function writerLogin(Request $request)
    {
        if (Auth::guard('writer')->attempt(['email' => $request->email, 'password' => $request->password, true])) {
            return redirect()->to('writer.dashboard');
        }
    }


}
