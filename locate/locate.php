<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Location on HERE Maps</title>
    <?php require('../inc/links.php'); ?> 

    <!-- HERE Maps CSS -->
    <link rel="stylesheet" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <style>
        #mapContainer {
            height: 500px;
            width: 100%;
        }
        #locationDetails {
            margin-top: 10px;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }
        #refreshMessage {
            display: none;
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }
        #timer {
            font-size: 16px;
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-light">

    <?php require('../inc/header.php'); ?> 

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">LIVE LOCATION</h2>
        <div class="h-line bg-dark"></div>
    </div>
    
    <div class="container col-10">
        <div id="mapContainer" class="mb-5"></div>
        <div id="locationDetails" class="container">
            <h4>Location Details:</h4>
            <p id="locationText">Fetching location...</p>
            <button onclick="refreshLocation()" class="btn btn-primary mt-3 shadow none mb-2">Refresh Location</button>
            <p id="refreshMessage">Location refreshed!</p> <!-- Temporary message -->
            <p>Next refresh in: <span id="timer">30</span> seconds</p>
        </div>
    </div>

    <?php require('../inc/footer.php'); ?> 

    <!-- HERE Maps JavaScript SDK -->
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>

    <script>
        const apiKey = '36508bwns8rxJNRNqbpp8TeEfvUYY9tIOou_X6yTvEo';

        const platform = new H.service.Platform({
            apikey: apiKey
        });
        const defaultLayers = platform.createDefaultLayers();
        const mapContainer = document.getElementById('mapContainer');
        const map = new H.Map(mapContainer, defaultLayers.raster.satellite.map, {
            zoom: 16,
            center: { lat: 0, lng: 0 }
        });
        
        const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
        const ui = H.ui.UI.createDefault(map, defaultLayers);
        let currentMarker;
        let timerInterval;
        let countdown = 30; // Initial countdown in seconds

        function displayLocationDetails(lat, lng, data) {
            const locationText = document.getElementById('locationText');
            const locality = data.address.city || data.address.town || data.address.village || data.address.county || "Unknown locality";
            locationText.innerHTML = `
                Locality: ${locality}<br>
                Latitude: ${lat.toFixed(4)}, Longitude: ${lng.toFixed(4)}<br>
            `;
        }

        function updateLocation(lat, lng) {
            map.setCenter({ lat: lat, lng: lng });
            if (currentMarker) {
                map.removeObject(currentMarker);
            }
            currentMarker = new H.map.Marker({ lat: lat, lng: lng });
            map.addObject(currentMarker);

            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
                .then(response => response.json())
                .then(data => {
                    displayLocationDetails(lat, lng, data);
                })
                .catch(error => {
                    document.getElementById('locationText').innerHTML = "Error fetching location details.";
                    console.error("Error fetching location details:", error);
                });

            currentMarker.setData(`Latitude: ${lat.toFixed(4)}, Longitude: ${lng.toFixed(4)}`);
            currentMarker.addEventListener('tap', function (evt) {
                const bubble = new H.ui.InfoBubble(evt.target.getGeometry(), {
                    content: evt.target.getData()
                });
                ui.addBubble(bubble);
            });
        }

        function refreshLocation() {
            showTemporaryMessage();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    // Update location on the map
                    updateLocation(lat, lng);
                    
                    // Save location to database via AJAX
                    updateLocationInDB(lat, lng);

                    // Reset countdown timer
                    resetTimer();

                }, error => {
                    document.getElementById('locationText').innerHTML = "Error fetching location.";
                    console.error("Error fetching location:", error);
                });
            } else {
                document.getElementById('locationText').innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function updateLocationInDB(lat, lng) {
            fetch('save_location.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `latitude=${lat}&longitude=${lng}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    console.log("Location saved successfully");
                } else {
                    console.error("Failed to save location:", data.message);
                }
            })
            .catch(error => {
                console.error("Fetch error:", error);
            });
        }

        function startTimer() {
            timerInterval = setInterval(() => {
                if (countdown === 0) {
                    refreshLocation();
                    countdown = 30; // Reset countdown
                } else {
                    countdown--;
                }
                document.getElementById('timer').innerText = countdown;
            }, 1000);
        }

        function resetTimer() {
            clearInterval(timerInterval);
            countdown = 30;
            document.getElementById('timer').innerText = countdown;
            startTimer();
        }

        function showTemporaryMessage() {
            const refreshMessage = document.getElementById('refreshMessage');
            refreshMessage.style.display = 'block';  // Show the message
            setTimeout(() => {
                refreshMessage.style.display = 'none'; // Hide after 2 seconds
            }, 2000);
        }

        // Initialize location fetch and start countdown
        refreshLocation();
        startTimer();

    </script>

</body>
</html>
