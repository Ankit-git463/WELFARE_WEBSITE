<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find My Location</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="card-title mb-4">Geolocation: Find My Location</h1>
                        
                        <!-- Button to trigger location -->
                        <button id="find-me" class="btn btn-primary mb-3">Show my location</button>
                        
                        <!-- Status message -->
                        <p id="status" class="text-muted"></p>
                        
                        <!-- Link to the map -->
                        <a id="map-link" target="_blank" class="btn btn-link"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and JavaScript dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript for geolocation -->
    <script>
        function geoFindMe() {
            const status = document.querySelector("#status");
            const mapLink = document.querySelector("#map-link");

            // Clear previous map link and status
            mapLink.href = "";
            mapLink.textContent = "";

            // Success callback for geolocation
            function success(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                // Clear status message
                status.textContent = "";    
                
                // Set the link to OpenStreetMap with user's coordinates
                mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
                mapLink.textContent = `Latitude: ${latitude}°, Longitude: ${longitude}°`;
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
