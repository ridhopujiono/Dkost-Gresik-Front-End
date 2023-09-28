<?php

namespace App\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RoomDetail extends Component
{
    public $roomId;
    public $date = '';
    public $phone = '';
    public $room = [];

    public function mount()
    {
        if ($this->roomId) {
            $response = Http::get(env('APP_URL_API') . "/rooms/" . $this->roomId);
            $this->room = $response->json();
        }
    }
    public function reservation($type)
    {
        if (!auth()->user()) {
            return session()->flash('error', 'Anda perlu login untuk reservasi');
        }
        if ($this->date == '') {
            return session()->flash('error', 'Anda perlu mengisi tanggal pengajuan');
        }
        if ($this->phone == '') {
            return session()->flash('error', 'Anda perlu mengisi nomor whatsapp');
        }
        if (strlen($this->phone) > 14) {
            return session()->flash('error', 'Nomor Whatsapp terlalu panjang');
        }
        try {
            $reservation = Http::post(env('APP_URL_API') . "/rooms/reservation/" . $this->roomId . "/" . auth()->user()->id . ($type == "booking" ? "/booking" : "/full_booked"), [
                'guest_name' => auth()->user()->name,
                'request_date' => $this->date,
                'phone' => $this->phone
            ]);
            $data = $reservation->json();
            if ($data['success']) {
                session()->flash('success', $data['data']);
            } else {
                session()->flash('error', $data['data']);
            }
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.room-detail');
    }
}
