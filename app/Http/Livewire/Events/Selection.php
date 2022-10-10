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
        $this->activeEvents = Events::where('endDateTime', '>', date('Y-m-d 23:59:59'))->get();

        if($this->event) {
            $teamIds       = Teams::where('event_id', '=', $this->event)->pluck('id');
            $this->teams   = Teams::select(['teams.*', DB::raw('SUM(teams.id) as total_sales')])
                                    ->where('event_id', '=', $this->event)
                                    ->groupBy('teams.id')
                                    ->get();

            $this->records = Records::where('event_id', '=', $this->event)
                                    ->whereIn('team_id', $teamIds)
                                    ->orderByDesc('pointsCount')
                                    ->get();
        }

        return view('livewire.events.selection', [

        ]);
    }

    function selectEvent() {
        // Set the var in session
        session()->put('eventId', $this->eventId);
    }
}
