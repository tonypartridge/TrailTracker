<div class="w-screen">
    <div class="relative overflow-hidden mb-8">
        <div class="h-full overflow-hidden p-4 px-3 py-4 flex justify-center">
            <div class="w-full max-w-sm">
                @if(isset($location->name))
                <h1 class="text-center text-lg text-white">You have arrived at:<br><span class="underline font-bold">{{ $location->name }}</span></h1><br/>
                @else
                    <div class="w-full bg-red-600 mt-6">
                        <div class="text-danger text-white p-4 font-bold">Location not found with the ID provided!</div>
                    </div>
                @endif
                <form class="bg-white shadow-md px-8 pt-6 pb-8 mb-4" wire:submit.prevent="submit" >
                    <div class="mb-6 bib">
                        @if($team)
                            <h1 class="text-center text-lg relative">Go get em <span class="font-bold">{{ $team->name }}!</span> <span class="font-bold bg-red-500 rounded-full h-4 w-4 text-white inline-block text-xs cursor-pointer absolute " wire:click="resetTeam" style="position: absolute;margin-top: 6px;margin-left: 6px;">X</span></h1>
                            <input class="shadow appearance-none border w-full py-2 px-3 text-gray-700 text-center mt-2 leading-tight focus:outline-none focus:shadow-outline"
                                   id="team_id" type="hidden" name="team_id" wire:model="team_id" placeholder="Team Number">

                        @else
                        <label class="block text-gray-700 text-sm font-bold mb-2 text-center" for="bib">
                            Team Number
                        </label>
                        <div id="keypad" class="flex flex-wrap -mx-2 overflow-hidden text-center">
                            <div class="py-4 px-4 w-1/3 overflow-hidden border-r-2 border-b-2 kn cursor-pointer" data-value="1">
                                1
                            </div>
                            <div class="py-4 px-4 w-1/3 overflow-hidden border-r-2 border-b-2 kn cursor-pointer" data-value="2">
                                2
                            </div>
                            <div class="py-4 px-4 w-1/3 overflow-hidden border-b-2 kn cursor-pointer" data-value="3">
                                3
                            </div>
                            <div class="py-4 px-4 w-1/3 overflow-hidden border-r-2 border-b-2 kn cursor-pointer" data-value="4">
                                4
                            </div>
                            <div class="py-4 px-4 w-1/3 overflow-hidden border-r-2 border-b-2 kn cursor-pointer" data-value="5">
                                5
                            </div>
                            <div class="py-4 px-4 w-1/3 overflow-hidden border-b-2 kn cursor-pointer" data-value="6">
                                6
                            </div>
                            <div class="py-4 px-4 w-1/3 overflow-hidden border-r-2 border-b-2 kn cursor-pointer" data-value="7">
                                7
                            </div>
                            <div class="py-4 px-4 w-1/3 overflow-hidden border-r-2 border-b-2 kn cursor-pointer" data-value="8">
                                8
                            </div>
                            <div class="py-4 px-4 w-1/3 overflow-hidden kn border-b-2 cursor-pointer" data-value="9">
                                9
                            </div>
                            <div class="py-4 px-4 w-1/3 overflow-hidden reset-field border-r-2 cursor-pointer">
                                CLEAR
                            </div>
                            <div class="py-4 px-4 w-1/3 overflow-hidden kn border-r-2 cursor-pointer" data-value="0">
                                0
                            </div>
                            <div class="text-4xl w-1/3 overflow-hidden rm-last cursor-pointer">
                                <
                            </div>
                        </div>
                        <input class="shadow appearance-none border w-full py-2 px-3 text-gray-700 text-center mt-2 leading-tight focus:outline-none focus:shadow-outline"
                               id="team_id" type="number" name="team_id" wire:model.defer="team_id" placeholder="Team Number">
                        @endif
                        <input class="shadow appearance-none border w-full py-2 px-3 text-gray-700 text-center mt-2 leading-tight focus:outline-none focus:shadow-outline"
                               id="loc_id" type="number" name="loc_id" wire:model="loc_id" placeholder="Location Number">
                    </div>

                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 w-full hover:bg-blue-700 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                                type="submit" id="save" @if(!isset($location->name)) disabled @endif>
                            CONFIRM
                        </button>
                    </div>
                    @if($saved)
                    <div class="w-full bg-green-600 mt-6">
                        <div class="text-danger text-white p-4 font-bold">Location Saved!</div>
                    </div>
                    @endif
                    @error('team_id')
                        <div class="w-full bg-red-500 mt-6"><div class="text-danger text-white p-4 font-bold">{{ $message }}</div></div>
                    @enderror
                </form>
                <p class="text-center text-gray-500 text-xs">
                    &copy; 2021 - <?php echo date("Y"); ?> {{ config('app.name', 'TrailTracker') }}. All rights reserved.
                </p></div>
        </div>
    </div>
    <script>
        document.addEventListener('click', function (event) {

            let numDisplay = document.getElementById('team_id');

            if (event.target.matches('.kn')) {
                let num = event.target.dataset.value;
                numDisplay.value = numDisplay.value + '' + num;
            } else if (event.target.matches('.reset-field')) {
                numDisplay.value = '';
            } else if (event.target.matches('.rm-last')) {
                numDisplay.value = numDisplay.value.slice(0, -1);
            } else {
                // Ops the element doesn't have the right selector, bail
                return;
            }

            numDisplay.dispatchEvent(new Event('input'));

            // Don't follow the link
            event.preventDefault();

        }, false);


    </script>
</div>
