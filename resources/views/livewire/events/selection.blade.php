<div>
    <!-- Event Select -->
    <div class="w-96 text-white p-6" wire:poll.200000ms>
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
            @php $pos = 1; @endphp
            @foreach($rankings as $ranking)
                <div id="rankings">
                @foreach($ranking as $i => $team)
{{--                    @dd($team);--}}
                    @if(isset($team['records']))
{{--                        @dd($team)--}}
                    <div class="flex border-b-2 border-gray-400" data-tid="{{ $team['id'] }}" data-name="{{ $team['name'] }}" data-lat="{{ $team['records'][0]['lat'] }}"
                         data-lon="{{ $team['records'][0]['lon'] }}" data-datetime="{{ $team['records'][0]['created_at'] }}">

                        <div class="px-2 py-2">{!! $pos . '<small>' . date("S", mktime(0, 0, 0, 0, $pos, 0)) . '</small>' !!}</div>
                        <div class="flex-auto text-center border-gray-400 px-2 py-2 font-bold">{{ $team['name'] }}</div>
                        <div class="px-2 py-2">{{ $team['points'] }}</div>

                    </div>
                    @endif

                    @php ++$pos @endphp
                @endforeach
                </div>
            @endforeach
        @endif
    </div>
</div>
