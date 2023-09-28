<?php

namespace App\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ResidentNotification extends Component
{
    public $notifs;

    public function changeReadStatus()
    {
        Http::post(env('APP_URL_API') . "/notification/update_read_status/user_id/" . auth()->user()->id)->json()['data'];
    }

    public function render()
    {
        try {
            $this->notifs = Http::post(env('APP_URL_API') . "/notification/user_id/" . auth()->user()->id)->json()['data'];
            $this->changeReadStatus();
        } catch (Exception $e) {
            session()->flash('error', 'Ada kesalahan sistem. Error' . $e->getMessage());
        }
        return view('livewire.resident-notification');
    }
}
