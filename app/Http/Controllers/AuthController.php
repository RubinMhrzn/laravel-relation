<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\{
    Writer
};

use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showRegisterPage()
    {
        return view('writer.register');
    }

    public function forgetPassword()
    {
        return view('writer.forget-password');
    }

    public function setPassword(Request $request)
    {
        $token = $request->query('token');

        return view('writer.set-password', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
            'token' => 'required',
        ]);

        $tokenEmail = PasswordResetToken::where('token', $request->token)->value('email');

        if (!$tokenEmail) {
            return redirect()->route('login')->with('error', 'Invalid or expired token.');
        }

        $writer = Writer::whereEmail($tokenEmail)->first();

        if (!$writer) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        $writer->password = Hash::make($request->password);
        $writer->save();

        PasswordResetToken::where('token', $request->token)->delete();
        return redirect()->route('writer.login')->with('message', 'Password successfully reset. Please log in.');
    }

    public function sendPasswordResetToken(Request $request)
    {
        $email = $request->email;

        $existsWriter = Writer::whereEmail($email)->exists();
        if (!$existsWriter) {
            return redirect()->back()->with('error', 'Email not found.');
        }

        $token = PasswordResetToken::whereEmail($email)->value('token');

        if (!$token) {
            $token = Str::random(60);

            PasswordResetToken::create([
                'email' => $email,
                'token' => $token,
            ]);
        }

        Mail::to($email)->send(new PasswordResetMail($token));

        return redirect()->back()->with('message', 'Password reset link has been sent to your email.');
    }

    public function showLoginPage()
    {
        return view('writer.login');
    }

    public function register(Request $request)
    {
        $user = Writer::create([
            'name' => $request->name,
            'email' => $request->email,
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
            return redirect()->route('writer.dashboard');
        }

        return back()->withErrors([
            'identity' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('writer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('writer.login');
    }
}
