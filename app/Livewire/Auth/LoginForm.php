<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginForm extends Component
{
    public $email, $password, $remember = false;

    public function render()
    {
        return view('livewire.auth.login-form');
    }
    public function authenticate()
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $not_verified = User::where('email', $credentials['email'])->whereNull('email_verified_at');

        if (Auth::attempt($credentials, $this->remember)) {
            if ($not_verified->exists()) {
                // Send email verification
                event(new Registered($not_verified->get()[0]));

                // make auth 
                auth()->login($not_verified->get()[0]);

                return redirect()->route('verification.notice');
            } else {
                session()->regenerate();

                return redirect('/');
            }
        }

        session()->flash('error', 'Email atau password yang anda masukan salah');
    }
}
