<div>
    <!-- Event Select -->
    <div class="w-96 text-white p-6" wire:poll.2000ms>
        @if(count($activeEvents) > 0)
        <form>
            <select id="event" wire:model="event" class="w-full bg-transparent" data-selected_event_id="{{ $event }}" wire:change="selectEvent">
                <option value=""> -- Select Event --</option>
                @foreach($activeEvents as $ev)
                    <option value="{{ $ev->id }}">{{ $ev->title }}</option>
                @endforeach
            </select>
        </form>
        @else
            <strong>Sorry, no active events are currently in progress</strong>
        @endif

        @if($event && is_countable($teams) && count($teams) > 0)
            <h2 class="text-white my-4 text-lg font-bold">Current Rankings</h2>
            @php $c = 1 @endphp
            @foreach($teams as $i => $team)
                {{ $c }}. {{ $team->name }} <br>
                @php ++$c @endphp
            @endforeach
        @endif
</div>
<script>
    <!-- Build out the markers -->


{{--                            @foreach($riders as $rider)--}}

{{--var marker{{ $vessel->id }} = L.marker([{{ $vessel->cLoc->latitude }}, {{ $vessel->cLoc->longitude }}]).addTo(map);--}}
{{--marker{{ $vessel->id }}.bindPopup("<p><b>Vessel: {{ $vessel->name }}</b><hr><br>Current Location: {{ $vessel->cLoc->current_area }}<br>Latitude: {{ $vessel->cLoc->latitude }}<br>Longitude: {{ $vessel->cLoc->longitude }}<br>Course: {{ $vessel->cLoc->course }}<br>Speed: {{ $vessel->cLoc->speed }}<br>Destination: {{ $vessel->cLoc->destination }}<br>ETA: {{ date('d-m-Y H:i', $vessel->cLoc->eta) }}<br>Next Port: {{ $vessel->cLoc->next_port }}<br>Current Port: {{ $vessel->cLoc->current_port }}</p><p class='text-center'><small>Updated: {{ date('H:i d-m-Y', $vessel->cLoc->unixtime) }}</small></p>");--}}

{{--                            @endforeach--}}
document.addEventListener('DOMContentLoaded', function () {

});

</script>

</div>
