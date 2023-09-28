<?php

namespace App\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MyRoom extends Component
{
    public $rooms = [];

    public function mount()
    {
        try {
            $resident = Http::post(env('APP_URL_API') . "/resident/" . "user_id/" . auth()->user()->id);
            $this->rooms = $resident->json()['data'];
        } catch (Exception $e) {
            $this->rooms = [];
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.my-room');
    }
}
