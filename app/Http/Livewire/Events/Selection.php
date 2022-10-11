<?php

namespace App\Http\Livewire\Events;

use App\Models\Events;
use App\Models\Records;
use App\Models\Teams;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Selection extends Component
{
    public $activeEvents;

    public $eventId;

    public $records;

    public $events;

    public $event;

    public $teams;

    public function mount() {
        $this->eventId  = session()->get('eventId', '');
    }

    public function render()
    {

        // TODO - Rework this to a multi-rational query - head hurts atm
        $this->activeEvents = Events::where('endDateTime', '>', date('Y-m-d 23:59:59'))->get();

        if($this->event) {
            $teamIds       = Teams::where('event_id', '=', $this->event)->pluck('id');
            $this->teams   = Teams::select(['teams.*'])
                                    ->where('event_id', '=', $this->event)
                                    ->groupBy('teams.id')
                                    ->get();

            foreach($this->teams as $it => $team) {
                $this->teams[$it]['records'] = Records::select([
                                                            'records.event_id',
                                                            'records.team_id',
                                                            'records.location_id',
                                                            'records.points',
                                                            'locations.lat',
                                                            'locations.lon',
                                                            'locations.created_at',
                                                        ])
                                                        ->where('team_id', '=', $team->id)
                                                        ->leftJoin('locations', 'records.location_id', '=', 'locations.id')
                                                        ->get();

                $this->teams[$it]['points'] = $this->teams[$it]['records']->sum('points');
            }
        }

        return view('livewire.events.selection', [

        ]);
    }

    function selectEvent() {
        // Set the var in session
        session()->put('eventId', $this->eventId);
    }
}
