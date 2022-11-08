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

        // L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        L.tileLayer('https://tile.opentopomap.org/{z}/{x}/{y}.png', {
            maxZoom: 17,
            attribution: '© OpenStreetMap'
        }).addTo(map);


        window.addEventListener('updateMarkers', event => {

            map.eachLayer(function (layer) {
                map.removeLayer(layer);
            });

            L.tileLayer('https://tile.opentopomap.org/{z}/{x}/{y}.png', {
                maxZoom: 17,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // We selected a team, so we will update the markers

            let checkPoints = document.querySelectorAll("#checkPoints > div");
            let checkPointIds   = [];
            if(checkPoints) {

                window.layerGroup = L.layerGroup().addTo(map);

                const svgIcon = L.divIcon({
                    html: `<x-ri-flag-line class="w-10 h-10 text-red-500 fill-current bg-white rounded-full p-1 border-2 border-red-500"/>`,
                    className: "",
                    iconSize: [8, 8],
                    iconAnchor: [17, 6],
                });

                checkPoints.forEach((cp) => {
                    var markerName = 'marker_' + cp.dataset.tid;
                    checkPointIds.push(markerName);
                    var markerName = L.marker([cp.dataset.lat, cp.dataset.lon], { clickable: true, draggable: false, icon: svgIcon} ).addTo(layerGroup);
                    markerName.bindPopup("<p><b>" + cp.dataset.name + "</b></p>", {maxWidth: 400});
                });

            }


            let teams = document.querySelectorAll("#rankings > div");
            let markerIds   = [];
            if(teams) {

                window.layerGroup = L.layerGroup().addTo(map);

                const svgIcon = L.divIcon({
                    html: `<x-tabler-bike class="w-8 h-8 text-green-700 fill-current bg-white rounded-full p-1 border-2 border-green-700"/>`,
                    className: "",
                    iconSize: [8, 8],
                    iconAnchor: [20, -30],
                });

                teams.forEach((teamItem) => {
                    var markerName = 'marker_' + teamItem.dataset.tid;
                    window[markerName] = L.marker([teamItem.dataset.lat, teamItem.dataset.lon], { clickable: true, draggable: false, icon: svgIcon}).addTo(layerGroup);
                    window[markerName].bindPopup("<p><b>" + teamItem.dataset.name + "</b></p><p>Received at: " + teamItem.dataset.datetime, {maxWidth: 400});
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

        function goToTeam(id, lat, lon) {
            console.log(id);
            map.flyTo([lat, lon], 16);
            window['marker_' + id].openPopup();
        }

    </script>
</div>
