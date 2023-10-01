<?php

namespace App\Livewire\Auth;

use App\Jobs\SendVerificationJob;
use App\Models\User;
use Livewire\Component;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterForm extends Component
{

    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::updateOrcreate(['email' => $this->email], [
            'name' => $this->name,
            'password' => Hash::make($this->password),
            'level' => 'guest',
            'profile_picture' => 'https://img.icons8.com/material-rounded/48/7950F2/user-male-circle.png'
        ]);

        // Send email verification
        event(new Registered($user));

        // make auth 
        auth()->login($user);

        return redirect()->route('verification.notice');
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }
}
