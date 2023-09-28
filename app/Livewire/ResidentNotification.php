<?php

namespace App\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ResidentNotification extends Component
{
    public $notifs;

    public function render()
    {
        try {
            $this->notifs = Http::post(env('APP_URL_API') . "/notification/user_id/" . auth()->user()->id)->json()['data'];
        } catch (Exception $e) {
            dd($e);
        }
        return view('livewire.resident-notification');
    }
}
