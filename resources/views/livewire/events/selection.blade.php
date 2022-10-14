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
            @foreach($teams as $teamPoints)
            @foreach($teamPoints as $i => $team)
                @if(is_countable($team->records))
                <div class="flex border-b-2 border-gray-400" data-name="{{ $team->name }}" data-lat="{{ $team->records[0]->lat }}"
                     data-lon="{{ $team->records[0]->lat }}" data-datetime="{{ $team->records[0]->created_at }}">

                    <div class="px-2 py-2">{{ $c }}</div>
                    <div class="flex-auto text-center border-l-2 border-r-2 border-gray-400 px-2 py-2 font-bold">{{ $team->name }}</div>
                    <div class="px-2 py-2">{{ $team->points }}</div>

                </div>
                @endif

                @php ++$c @endphp
            @endforeach
            @endforeach
        @endif
    </div>
</div>
