<div class="min-h-screen flex-1">

    <!-- Map Render -->
    <div id="map" class="min-h-fit min-w-fit w-full h-full"></div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
          integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
            integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
            crossorigin=""></script>

    <script>
        const map = L.map('map', {
            zoomDelta: 0.50,
            zoomSnap: 0
        }).setView([54.211186, -4.583196], 11.50);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);


        window.addEventListener('updateMarkers', event => {

            let teams = document.querySelectorAll("#rankings > div");
            let markerIds   = [];
            if(teams) {
                map.eachLayer(function (layer) {
                    map.removeLayer(layer);
                });

                L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(map);

                window.layerGroup = L.layerGroup().addTo(map);

                teams.forEach((teamItem) => {
                    var markerName = 'marker_' + teamItem.dataset.tid;
                    markerIds.push(markerName);
                    var markerName = L.marker([teamItem.dataset.lat, teamItem.dataset.lon]).addTo(layerGroup);
                    markerName.bindPopup("<p><b>" + teamItem.dataset.name + "</b></p><p>Received at: " + teamItem.dataset.datetime, {maxWidth: 400});
                });

            }
            console.log(markerIds)

        });

        function clearMarker(id) {
            console.log(markers)
            var new_markers = []
            markers.forEach(function(marker) {
                if (marker._id == id) map.removeLayer(marker)
                else new_markers.push(marker)
            })
            markers = new_markers
        }
    </script>
</div>
