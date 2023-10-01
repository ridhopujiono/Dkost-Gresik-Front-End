<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use App\Livewire\RoomDetail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/privacy-policy', function () {
    return view('privacy_policy');
});
Route::get('/term-of-service', function () {
    return view('term_of_service');
});
// Google Login
Route::get('/auth/google', [AuthController::class, 'redirectToProvider']);
Route::get('/auth/google/callback', [AuthController::class, 'handleProviderCallback']);
Route::get('/auth/google/logout', [AuthController::class, 'handleLogout']);

// Manual Login
Route::get('/auth', [AuthController::class, 'auth']);
Route::get('/register', [AuthController::class, 'register']);

Route::controller(VerificationController::class)->group(function () {
    Route::get('/email/verify', 'notice')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::post('/email/resend', 'resend')->name('verification.resend');
});
Route::get('/room/{roomId}', function ($roomId) {
    return view('detail', ['roomId' => $roomId]);
});
//only authenticated can access this group
Route::group(['middleware' => ['auth']], function () {
    //only verified account can access with this group
    Route::group(['middleware' => ['verified']], function () {
        Route::get('/dash', function () {
            return view('dash.index', [
                'title' => 'Dkost Gresik | Dashboard'
            ]);
        });
        Route::get('/dash/notification', function () {
            return view('dash.notification', [
                'title' => 'Dkost Gresik | Notifikasi'
            ]);
        });
        Route::get('/dash/room', function () {
            return view('dash.room', [
                'title' => 'Dkost Gresik | Kamar Saya'
            ]);
        });
        Route::get('/dash/room/{resident_id}/{room_id}', function ($resident_id, $room_id) {
            return view('dash.detail', [
                'resident_id' => $resident_id,
                'room_id' => $room_id,
                'title' => 'Dkost Gresik | Detail Kamar Saya'
            ]);
        });
    });
});
