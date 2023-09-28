<?php

namespace App\Livewire;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class ResidentRoom extends Component
{
    use WithFileUploads;

    public $residentDetails = [];
    public $roomDetails = [];
    public $file;
    public $resident_id;
    public $room_id;

    public $name;
    public $address;
    public $contact;
    public $contact_name;
    public $contact_number;
    public $emergency_info;

    public $tab_active = 'payment';
    public $residentProfileComplete = false;

    public function mount($resident_id, $room_id)
    {
        $this->resident_id = $resident_id;
        $this->room_id = $room_id;

        $room = Http::get(env('APP_URL_API') . "/rooms/" . $this->room_id);
        $this->roomDetails = $room->json();

        $resident = Http::post(env('APP_URL_API') . "/resident/resident_id/" . $this->resident_id);
        $this->residentDetails = $resident->json()['data'];

        $this->name = $this->residentDetails['name'];
        $this->address = $this->residentDetails['address'];
        $this->contact = $this->residentDetails['contact'];
        $this->contact_name = $this->residentDetails['emergency_info']["contact_name"];
        $this->contact_number = $this->residentDetails['emergency_info']["contact_number"];
    }

    public function upload()
    {
        $validate = $this->validate([
            'file' => 'required|image|max:2048'
        ]);
        try {
            $response = Http::attach(
                'file',
                file_get_contents($this->file->getRealPath()),
                rand(1, 100) . "_" . Carbon::now()
            )->post(env('APP_URL_API') . "/resident/" . "payment_histories/resident_id/" . $this->resident_id);

            // Mengambil respons dari API jika diperlukan
            $apiResponse = $response->json()['data'];

            $this->dispatch('trigger-payment-histories', $this->resident_id);
            session()->flash('success', $apiResponse);
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function save()
    {
        sleep(2);
        $validate = $this->validate([
            'name' => 'required|min:2|max:100',
            'address' => 'required|min:2|max:255',
            'contact' => 'required|min:2|max:20',
            'contact_name' => 'required|min:2|max:100',
            'contact_number' => 'required|min:2|max:20',
        ]);
        $validate['emergency_info'] = [
            "contact_name" => $validate['contact_name'],
            "contact_number" => $validate['contact_number']
        ];

        try {
            $resident = Http::post(env('APP_URL_API') . "/resident/profile/" . $this->resident_id, $validate);

            if ($resident) {
                session()->flash('success', 'Berhasil mengubah data');
                $this->residentProfileComplete = true;
            }
        } catch (Exception $e) {
            session()->flash('error', 'Ada error disisi server. Pesan error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.resident-room');
    }

    public function tab_active_change($tab)
    {
        $this->tab_active = $tab;
    }
}
