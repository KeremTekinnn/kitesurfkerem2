<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class WeatherComponent extends Component
{
    public function render()
    {
        return view('livewire.weather-component');
    }
}
