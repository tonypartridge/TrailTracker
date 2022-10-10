<?php

namespace App\Http\Livewire\Record;

use App\Models\Events;
use App\Models\EventsLocations;
use App\Models\Locations;
use App\Models\Records;
use App\Models\Teams;
use Livewire\Component;

class Create extends Component
{
    public $loc_id, $location, $team_id, $team, $saved = false;

    public function render()
    {
        $this->location = EventsLocations::select(['locations.id AS id', 'events_locations.points', 'locations.name'])
                                            ->leftJoin('locations', 'events_locations.location_id', '=', 'locations.id')
                                            ->where('events_locations.location_id', '=', $this->loc_id)
                                            ->first();

        $this->team_id  = session()->get('team_id', null);

        if ($this->team_id) {
            $this->team = Teams::where('id', '=', $this->team_id)->first();
        }

        return view('livewire.record.create');
    }

    public function mount($loc_id)
    {
        $this->loc_id = $loc_id;
    }

    public function submit() {

        $validatedData = $this->validate([
            'loc_id' => 'required|min:1',
            'team_id' => 'required|min:1',
        ]);

        $this->team     = Teams::where('id', '=', $this->team_id)->first();

        if(!$this->team) {

            $this->addError('team_id', "Ops! We couldn't find the team for the number you entered...");

            return;
        }

        // Store the team id in the session
        session()->put('team_id', $this->team_id);

        $state = Records::create([
            'location_id'   => $this->loc_id,
            'team_id'       => $this->team_id,
            'event_id'      => $this->team->event_id,
            'points'        => $this->location->points
        ]);

        if($state) {
            $this->saved = true;
        }
    }

    public function resetTeam() {
        session()->forget('team_id');
        unset($this->team_id);
        unset($this->team);

    }

}
