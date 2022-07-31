<div class="w-full h-full min-h-screen">
    <div class="bg-gray-800 overflow-hidden shadow">
        <div class="flex min-h-screen">

            <!-- Event Select -->
            <div class="w-96 text-white p-6">
                TODO:
                Add Event Selectors<br>
                Build Team List<br>
                Show Team Position in ranking and on map<br>
            </div>
            <!-- Map Render -->
            <div class="min-h-screen flex-1" id="map"></div>


            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
                  integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
                  crossorigin=""/>
            <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
                    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
                    crossorigin=""></script>

            <script>
                var map = L.map('map', {
                    zoomDelta: 0.25,
                    zoomSnap: 0
                }).setView([54.211186, -4.583196], 11.25);
                L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(map);
                {{--                            @foreach($riders as $rider)--}}

                {{--var marker{{ $vessel->id }} = L.marker([{{ $vessel->cLoc->latitude }}, {{ $vessel->cLoc->longitude }}]).addTo(map);--}}
                {{--marker{{ $vessel->id }}.bindPopup("<p><b>Vessel: {{ $vessel->name }}</b><hr><br>Current Location: {{ $vessel->cLoc->current_area }}<br>Latitude: {{ $vessel->cLoc->latitude }}<br>Longitude: {{ $vessel->cLoc->longitude }}<br>Course: {{ $vessel->cLoc->course }}<br>Speed: {{ $vessel->cLoc->speed }}<br>Destination: {{ $vessel->cLoc->destination }}<br>ETA: {{ date('d-m-Y H:i', $vessel->cLoc->eta) }}<br>Next Port: {{ $vessel->cLoc->next_port }}<br>Current Port: {{ $vessel->cLoc->current_port }}</p><p class='text-center'><small>Updated: {{ date('H:i d-m-Y', $vessel->cLoc->unixtime) }}</small></p>");--}}

                {{--                            @endforeach--}}
                document.getElementById('map').addEventListener('change', function handleChange(event) {
                    let markerToOpen    = window['marker' + event.target.value];
                    const [option]      = event.target.selectedOptions;
                    var latlng          = [option.dataset.lat,option.dataset.lon];

                    map.setZoomAround(latlng, 10);
                    map.panTo(latlng);
                    markerToOpen.openPopup();
                    console.log(event.target.value);
                });


            </script>

        </div>
    </div>
</div>
