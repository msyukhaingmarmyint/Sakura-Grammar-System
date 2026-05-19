<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password field is required.',
        ]);
    }


    protected function attemptLogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->filled('remember'));
            return true;
        }

        return false;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email has not already registered!'
            ])->withInput();
        }

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'password' => 'Password is incorrect!'
            ])->withInput();
        }
        
        Auth::login($user);

        if ($user->status === 'inactive') {
            Auth::logout();

            return redirect()->back()->with([
                'error' => 'Your account is already deactivated!',
                'inactive_email' => $user->email
            ]);
        }

        if ($user->role === 'admin') {
            return redirect('/admin')->with('success', 'Login Successfully!');
        }

        return redirect('/')->with('success', 'Login Successfully!');
    }
}
