<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RoomSearch extends Component
{
    public $rooms = [];
    public $nextPageUrl = null;
    public $currentPage = 1; // Inisialisasi halaman pertama
    public $search = '';
    public $room_type = '';

    public function fetchData($isAppend)
    {
        $response = Http::get(env('APP_URL_API') . "/rooms", [
            'search' => $this->search,
            'room_type' => $this->room_type,
            'page' => $this->currentPage, // Mengirim parameter halaman yang diinginkan
        ]);

        $data = $response->json();

        if ($isAppend) {
            $this->rooms = array_merge($this->rooms, $data['data']);
            $this->nextPageUrl = $data['next_page_url'];
        } else {
            $this->rooms = $data['data'];
            $this->nextPageUrl = $data['next_page_url'];
        }
    }

    public function doSearch()
    {
        sleep(1);
        $this->fetchData(false);
    }

    public function loadMoreData()
    {
        sleep(1);
        $this->currentPage++;
        $this->fetchData(true);
    }

    public function render()
    {
        return view('livewire.room-search');
    }
    public function mount()
    {
        $this->fetchData(false);
    }
}
