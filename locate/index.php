<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Location on Leaflet Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }
        #map {
            height: 600px; /* Set the height of the map */
            width: 100%; /* Set the width of the map */
            border-radius: 0.5rem; /* Rounded corners for the map */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow for the map */
        }
        .container {
            margin-top: 20px; /* Space above the container */
        }
        footer {
            background-color: #343a40; /* Dark background for footer */
            color: white;
            padding: 10px 0;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Location Tracker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mt-4">Locate Your Device on the Map</h1>
        <p class="text-center">Click the button below to find your current location.</p>
        <div class="text-center mb-4">
            <button id="getLocationBtn" class="btn btn-primary">Get Location</button>
        </div>
        <div id="map" class="mb-4"></div>
    </div>

    <footer>
        <div class="container">
            <p class="mb-0">© 2023 Location Tracker. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>