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

    // Validate email and password
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

    // Handle login attempt
    protected function attemptLogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->filled('remember'));
            return true;
        }

        return false;
    }

    // Custom error messages
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Email exists but password is wrong
            $errors = ['password' => 'Password is incorrect.'];
        } else {
            // Email does not exist
            $errors = ['email' => 'This email has not been already existed.'];
        }

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors($errors);
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->status === 'inactive') {
            Auth::logout();
            return redirect()->back()
                ->with('error', 'Your account is already deactivated!');
        }

        if ($user->role === 'admin') {
            return redirect('/admin')->with('success', 'Login Succesfully!');
        }

        return redirect('/')->with('success', 'Login Succesfully!');
    }
}
