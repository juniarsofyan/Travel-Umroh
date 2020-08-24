<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ItineraryEvents extends Component
{
    public $jumlahHari;
    public $daftarKegiatan = [];

    public function mount($jumlahHari)
    {
        $this->jumlahHari = $jumlahHari;
    }

    public function render()
    {
        return view('livewire.itinerary-events');
    }
}
