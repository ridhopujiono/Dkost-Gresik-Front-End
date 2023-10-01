<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite; //tambahkan library socialite
use App\Models\User; //tambahkan model user
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Goole Login
    public function redirectToProvider()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleProviderCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();
            // Cari pengguna berdasarkan alamat email.
            $existingUser = User::where('email', $user->email)->first();

            if (!$existingUser) {
                // Buat pengguna baru jika email tidak ditemukan.
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->profile_picture = $user->avatar;
                $newUser->level = 'guest';
                $newUser->password = bcrypt("$newUser->name" . "$newUser->email");
                // Tambahkan kolom lain sesuai kebutuhan Anda.
                $newUser->save();
            }

            auth()->login($existingUser ?? $newUser, true); // Menggunakan 'true' untuk mengaktifkan fitur "Remember Me".auth()->login($existingUser ?? $newUser);


            return redirect('/')->with('success', 'Berhasil login');
        } catch (Exception $e) {
            return redirect('/')->with('error', 'Gagal login. Error: ' . $e->getMessage());
        }
    }

    // Manual Login
    public function auth()
    {
        return view('welcome');
    }
    public function register()
    {
        return view('register');
    }


    public function handleLogout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
