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
    public $ktp_number;
    public $ktp_image;
    public $job;
    public $institute;
    public $institute_address;
    public $vehicle;
    public $vehicle_number;

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
        $this->ktp_number = $this->residentDetails['ktp_number'];
        $this->ktp_image = $this->residentDetails['ktp_image'];
        $this->job = $this->residentDetails['job'];
        $this->institute = $this->residentDetails['institute'];
        $this->institute_address = $this->residentDetails['institute_address'];
        $this->vehicle = $this->residentDetails['vehicle'];
        $this->vehicle_number = $this->residentDetails['vehicle_number'];
    }

    public function uploadFile()
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
            'ktp_number' => 'required|min:2|max:20',
            'job' => 'required|min:2|max:100',
            'institute' => 'required|min:2|max:100',
            'institute_address' => 'required|min:2|max:200',
            'vehicle' => 'required|min:2|max:10',
            'vehicle_number' => 'required|min:2|max:10',
        ]);
        $validate['emergency_info'] = [
            "contact_name" => $this->contact_name,
            "contact_number" => $this->contact_number
        ];

        try {
            // dd($this->ktp_image);
            $client = new \GuzzleHttp\Client();
            $resident = $client->request('POST',  env('APP_URL_API') . "/resident/profile/" . $this->resident_id, [
                'multipart' => [
                    [
                        'name' => 'ktp_image',
                        'contents' =>
                        file_get_contents($this->ktp_image->getRealPath()),
                        'filename' => rand(1, 100) . "_" . Carbon::now(),
                        'Mime-Types' => $this->ktp_image->getMimeType('image')
                    ],
                    [
                        'name' => 'name',
                        'contents' => $validate['name']
                    ],
                    [
                        'name' => 'address',
                        'contents' => $validate['address']
                    ],
                    [
                        'name' => 'contact',
                        'contents' => $validate['contact']
                    ],
                    [
                        'name' => 'ktp_number',
                        'contents' => $validate['ktp_number']
                    ],
                    [
                        'name' => 'job',
                        'contents' => $validate['job']
                    ],
                    [
                        'name' => 'institute',
                        'contents' => $validate['institute']
                    ],
                    [
                        'name' => 'institute_address',
                        'contents' => $validate['institute_address']
                    ],
                    [
                        'name' => 'vehicle',
                        'contents' => $validate['vehicle']
                    ],
                    [
                        'name' => 'vehicle_number',
                        'contents' => $validate['vehicle_number']
                    ],
                    [
                        'name' => 'contact_name',
                        'contents' => $this->contact_name
                    ],
                    [
                        'name' => 'contact_number',
                        'contents' => $this->contact_number
                    ],
                ]
            ]);

            if ($resident) {
                session()->flash('success', 'Berhasil mengubah data');
                $this->residentProfileComplete = true;
            } else {
                session()->flash('error', 'Gagal mengubah data');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
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
