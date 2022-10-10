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
        let map = L.map('map', {
            zoomDelta: 0.25,
            zoomSnap: 0
        }).setView([54.211186, -4.583196], 11.25);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        document.getElementById('map').addEventListener('change', function handleChange(event) {
            let markerToOpen = window['marker' + event.target.value];
            const [option] = event.target.selectedOptions;
            var latlng = [option.dataset.lat, option.dataset.lon];

            map.setZoomAround(latlng, 10);
            map.panTo(latlng);
            markerToOpen.openPopup();
            console.log(event.target.value);
        });
    </script>

</div>
