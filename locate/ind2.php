<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Location Tracker</title>
    <?php require('../inc/links.php') ?> 
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body {
            background-color: #f8f9fa; /* Light background */
        }
        #map {
            height: 600px; /* Set the height of the map */
            width: 100%; /* Set the width of the map */
            border-radius: 0.5rem; /* Rounded corners for the map */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow for the map */
        }
        .info-box {
            background-color: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-light">

    <?php require('../inc/header.php') ?> 

    <div class="container my-4">
        <div class="text-center mb-4">
            <button id="getLocationBtn" class="btn btn-primary">Get My Location</button>
        </div>
        <div id="map" class="mb-4"></div>
        <div class="info-box text-center">
            <h5>Your Current Location:</h5>
            <p id="locationDetails">Click the button above to find your location.</p>
        </div>

        <div id="allData" class="alert alert-secondary mt-3"></div>
    </div>

    <?php require('../inc/footer.php') ?> 

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        const map = L.map('map').setView([0, 0], 2); // Set initial view to a global view

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Function to get the current location
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        // Function to show the position on the map
        function showPosition(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            // Set the view to the user's location
            map.setView([lat, lng], 13);

            // Add a marker for the user's location
            L.marker([lat, lng]).addTo(map)
                .bindPopup("You are here!")
                .openPopup();

            // Update location details
            getLocality(lat, lng);
        }

        // Function to get locality name using reverse geocoding
        function getLocality(lat, lng) {
            const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const name = data.name ;
                    const locality = data.address.county || data.address.town || data.address.village || "Unknown locality";

                    document.getElementById('locationDetails').innerHTML = 
                        `Area: ${name} <br>Locality: ${locality}<br>Latitude: ${lat.toFixed(4)}<br>Longitude: ${lng.toFixed(4)}`;

                     // Display all fetched data in JSON format
                    // document.getElementById('allData').innerHTML = 
                    //     `<strong>Full Data:</strong><pre>${JSON.stringify(data, null, 2)}</pre>`;
                })
                .catch(error => {
                    console.error('Error fetching locality:', error);
                });
        }

        // Function to handle errors
        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }

        // Attach the getLocation function to the button click
        document.getElementById('getLocationBtn').addEventListener('click', getLocation);
    </script>
</body>
</html>