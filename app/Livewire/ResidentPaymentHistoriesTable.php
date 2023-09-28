<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class ResidentPaymentHistoriesTable extends Component
{
    public $resident_id;
    public $paymentHistories = [];

    #[On('trigger-payment-histories')]
    public function refreshData($resident_id)
    {
        $this->paymentHistories = Http::get(env('APP_URL_API') . "/resident/" . "payment_histories/resident_id/" . $resident_id)->json()['data'];
    }

    public function setPaymentHistories($resident_id)
    {
        $this->paymentHistories = Http::get(env('APP_URL_API') . "/resident/" . "payment_histories/resident_id/" . $resident_id)->json()['data'];
    }

    public function mount($resident_id)
    {
        $this->resident_id = $resident_id;
        $this->setPaymentHistories($resident_id);
    }
    public function render()
    {
        return view('livewire.resident-payment-histories-table');
    }
}
