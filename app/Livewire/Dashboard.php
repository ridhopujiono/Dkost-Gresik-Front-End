<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Dashboard extends Component
{
    public $contracts = [];
    public $processedContracts = [];

    public function mount()
    {
        $resident = Http::post(env('APP_URL_API') . "/resident/" . "user_id/" . auth()->user()->id);

        if (count($resident->json()['data']) > 0) {
            $this->contracts = $resident->json()['data'];

            collect($this->contracts)->each(function ($contract) {
                $this->processedContracts[] = [
                    'id' => $contract['id'],
                    'event_name' => $contract['room']['room_name'],
                    'event_start' => $contract['contract_start'],
                    'event_end' => $contract['contract_end'],
                ];
            });
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
