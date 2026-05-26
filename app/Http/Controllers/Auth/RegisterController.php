<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * 
     *
     * @var string
     */
    protected function redirectTo()
    {
        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     * This overrides the default method from the RegistersUsers trait.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $errors = $validator->errors();

            if ($errors->has('password')) {
                $passwordErrors = $errors->get('password');

                $firstError = array_shift($passwordErrors);

                // 3. Loop through remaining errors and strip "The password must contain" or "password"
                $cleanedRemaining = array_map(function($msg) {
                    // Removes "The password must contain " (case-insensitive)
                    $msg = preg_replace('/^the password must contain\s+/i', '', $msg);
                    // Also handles variations starting with "The password..."
                    $msg = preg_replace('/^the password\s+/i', '', $msg);
                    return $msg;
                }, $passwordErrors);

                // 4. Combine them cleanly using commas, and an "and" for the final rule
                if (!empty($cleanedRemaining)) {
                    // Turn "at least one symbol." into "at least one symbol" by removing trailing dots
                    $firstError = rtrim($firstError, '.');
                    
                    foreach ($cleanedRemaining as &$msg) {
                        $msg = rtrim($msg, '.');
                    }

                    if (count($cleanedRemaining) > 1) {
                        $lastMsg = array_pop($cleanedRemaining);
                        $combinedSentence = $firstError . ', ' . implode(', ', $cleanedRemaining) . ', and ' . $lastMsg . '.';
                    } else {
                        $combinedSentence = $firstError . ' and ' . $cleanedRemaining[0] . '.';
                    }
                } else {
                    $combinedSentence = $firstError;
                }

                // 5. Build the fresh MessageBag wrapper
                $messages = $errors->getMessages();
                $messages['password'] = [$combinedSentence];

                $errors = new \Illuminate\Support\MessageBag();
                $errors->merge($messages);
            }

            return redirect()->back()
                ->withInput($request->only('name', 'email'))
                ->withErrors($errors);
        }

        event(new Registered($user = $this->create($request->all())));

        return redirect()->route('login')
        ->with('success', 'Account created successfully! Please login.');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                'unique:users',
                'regex:/^[a-zA-Z0-9.]+@gmail\.com$/i' 
            ],
            'password' => [
                'required', 
                'string', 
                'confirmed',
                Password::min(8),
            ],
            'password_confirmation' => ['required'],
        ], [
            'name.required' => 'Please enter your full name.',
            'email.required' => 'Email is required!',
            'email.unique' => 'This email is already registered.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Passwords do not match.',
            'password_confirmation.required' => 'Confirm password is required!',
        ]);

        $validator->after(function ($validator) use ($data) {
            if (empty($data['password'])) {
                return;
            }

            $password = $data['password'];
            $missing = [];

            if (!preg_match('/[A-Z]/', $password)) {
                $missing[] = 'uppercase letter';
            }
            if (!preg_match('/[0-9]/', $password)) {
                $missing[] = 'number';
            }
            if (!preg_match('/[\W_]/', $password)) {
                $missing[] = 'special symbol';
            }            if (!empty($missing)) {
                if (count($missing) === 3) {
                    $msg = 'Password must contain at least one uppercase letter, number, and special symbol.';
                } elseif (count($missing) === 2) {
                    $msg = 'Password must contain at least one ' . $missing[0] . ' and ' . $missing[1] . '.';
                } else {
                    $msg = 'Password must contain at least one ' . $missing[0] . '.';
                }

                $validator->errors()->add('password', $msg);
            }
        });

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'user',
        ]);
    }
}
