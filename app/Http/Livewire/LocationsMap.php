<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LocationsMap extends Component
{

    public $records;

    public function render()
    {
;
        $this->records  = [];

        return view('livewire.locations-map');
    }

}
