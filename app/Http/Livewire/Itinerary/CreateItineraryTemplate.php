<?php

namespace App\Http\Livewire\Itinerary;

use Livewire\Component;

class CreateItineraryTemplate extends Component
{
    public $kodeTemplate;
    public $jumlahHari;
    public $isInputShown = false;

    public function mount($kodeTemplate = "", $jumlahHari = null)
    {
        $this->kodeTemplate = $kodeTemplate;
        $this->jumlahHari = $jumlahHari;
    }

    public function showInputBoxes()
    {
        $this->isInputShown = true;
    }

    public function hideInputBoxes()
    {
        $this->isInputShown = false;
    }

    public function render()
    {
        return view('livewire.itinerary.create-itinerary-template');
    }
}
