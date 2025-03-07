<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find My Location</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Maps API (replace YOUR_API_KEY with your actual API key) -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>

    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="card-title mb-4">Geolocation: Find My Location</h1>

                        <!-- Button to trigger location -->
                        <button id="find-me" class="btn btn-primary mb-3">Show my location</button>
                        
                        <!-- Status message -->
                        <p id="status" class="text-muted"></p>

                        <!-- Google Map -->
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and JavaScript dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript for geolocation and Google Maps -->
    <script>
        let map, marker;

        function initMap() {
            // Initialize the Google Map with a default center and zoom level
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: -34.397, lng: 150.644 }, // Default center (adjust as needed)
                zoom: 8
            });
        }

        function geoFindMe() {
            const status = document.querySelector("#status");

            // Success callback for geolocation
            function success(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                status.textContent = "";    
                
                // Center the map on the user's current location
                const userLocation = { lat: latitude, lng: longitude };
                map.setCenter(userLocation);
                map.setZoom(15); // Zoom in to the user's location

                // Place a marker at the user's current location
                if (marker) {
                    marker.setMap(null); // Remove the previous marker
                }
                marker = new google.maps.Marker({
                    position: userLocation,
                    map: map,
                    title: "You are here!"
                });
            }

            // Error callback for geolocation
            function error() {
                status.textContent = "Unable to retrieve your location.";
            }

            // Check if the browser supports geolocation
            if (!navigator.geolocation) {
                status.textContent = "Geolocation is not supported by your browser.";
            } else {
                status.textContent = "Locating…";
                
                // Request the current position
                navigator.geolocation.getCurrentPosition(success, error);
            }
        }

        // Add event listener to the button
        document.querySelector("#find-me").addEventListener("click", geoFindMe);
    </script>

</body>
</html>
