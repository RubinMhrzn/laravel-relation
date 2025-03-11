<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\{
    Writer
};

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterPage()
    {
        return view('writer.register');
    }

    public function showLoginPage()
    {
        return view('writer.login');
    }

    public function register(Request $request)
    {
        $user = Writer::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make('password'),
            'is_editor' => $request->is_editor ?? 0
        ]);

        event(new Registered($user));

        Auth::guard('writer')->login($user);

        return redirect(route('writer.dashboard.home', absolute: false));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::guard('writer')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->route('writer.dashboard.home');
        }

        return back()->withErrors([
            'identity' => 'The provided credentials do not match our records.',
        ])->onlyInput('identity');
    }

    public function logout(Request $request)
    {
        Auth::guard('writer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('writer.login');
    }
}
