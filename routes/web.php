<?php

use App\Http\Controllers\AuthController;
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
Route::get('/auth/google', [AuthController::class, 'redirectToProvider']);
Route::get('/auth/google/callback', [AuthController::class, 'handleProviderCallback']);
Route::get('/auth/google/logout', [AuthController::class, 'handleLogout']);

Route::get('/room/{roomId}', function ($roomId) {
    return view('detail', ['roomId' => $roomId]);
});
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
