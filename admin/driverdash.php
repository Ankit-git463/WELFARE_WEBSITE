<?php 
    require('inc/essentials.php');

    driverLogin() ; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Updates Page</title>
    
    <?php require('inc/links.php'); ?> 
    <link rel="stylesheet" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        #mapContainer { 
            height: 500px; 
            width: 100%; 
        }

        #customAlert {
            display: none;
            position: fixed;
            top: 10%;
            right: 2%;
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 5px;
            z-index: 1000;
            font-weight: bold;
        }

        .toggle-btn {
            width: 150px;
            height: 60px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 15px;
        }
        #locationText {
            margin-top: 10px;
        }
    </style>
</head>
<body class="bg-light">

    <?php require('inc/dheader.php'); ?> 

    <div class="container-fluid" id ="main-content">
        <div class="row ">
            <div class="col-lg-10 ms-auto p-3 overflow-hidden">
                <div class="container mt-2 text-center">
                    <h2 class="fw-bold h-font">Driver Dashboard</h2>
                    
                    <!-- Instruction message in blue background alert -->
                    <div class="alert alert-primary text-center mt-3" role="alert">
                        Click the toggle button to enable or disable location updates. When enabled, your location will update every 30 seconds, updating the database and the map marker in real-time.
                    </div>

                    <div class="form-check form-switch">

                        <input class="form-check-input toggle-btn" type="checkbox" id="locationToggle" onchange="toggleLocation()">
                        <label class="form-check-label" for="locationToggle">CHECK THE BUTTON FOR LOCATION UPDATED </label>
                    </div>

                    <br><br>
                    <div id="mapContainer" class="mt-4"></div>
                    <div id="customAlert">Location updated successfully!</div>

                    <div class="alert alert-primary text-center mt-3" role="alert">
                        THE DRIVER LOCATION GETS UPDATED EVERY 30 SECONDS.
                    </div>
                    
                </div>

                
            </div>
            
        </div>
    </div>



    

    <!-- HERE Maps JavaScript SDK -->
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    
    <?php require('inc/scripts.php'); ?> 


    <script>
        const apiKey = '36508bwns8rxJNRNqbpp8TeEfvUYY9tIOou_X6yTvEo';
        let locationEnabled = false;
        let start= false; 

        const platform = new H.service.Platform({ apikey: apiKey });
        const defaultLayers = platform.createDefaultLayers();
        const map = new H.Map(document.getElementById('mapContainer'), defaultLayers.raster.satellite.map, {
            zoom: 16,
            center: { lat: 0, lng: 0 }
        });
        
        const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
        const ui = H.ui.UI.createDefault(map, defaultLayers);
        let currentMarker;

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


            currentMarker.setData(`Latitude: ${lat.toFixed(4)}, Longitude: ${lng.toFixed(4)}`);
            currentMarker.addEventListener('tap', function (evt) {
                const bubble = new H.ui.InfoBubble(evt.target.getGeometry(), {
                    content: evt.target.getData()
                });
                ui.addBubble(bubble);
            });
        }

        function showAlert(message, success) {
            const customAlert = document.getElementById('customAlert');
            customAlert.style.backgroundColor = success ? '#4CAF50' : '#f44336';
            customAlert.textContent = message;
            customAlert.style.display = 'block';
            setTimeout(() => { customAlert.style.display = 'none'; }, 3000);
        }

        function toggleLocation() {
            locationEnabled = document.getElementById('locationToggle').checked;
            if (locationEnabled) {
                fetchLocation();
            }
        }

        function fetchLocation(start) {
            if(start == false) start = true ; 

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    updateLocation(lat, lng);
                    
                    // Update in the database only if toggle is enabled
                    if (locationEnabled & start) {
                        updateLocationInDatabase(lat, lng);
                    }
                });
            } else {
                showAlert("Geolocation is not supported by this browser.", false);
            }
        }

        function updateLocationInDatabase(lat, lng) {
            fetch('ajax/update_location.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ lat: lat, lng: lng })
            })
            .then(response => response.json())
            .then(data => showAlert(data.message, true))
            .catch(error => showAlert('Error updating location: ' + error.message, false));
        }

        fetchLocation(start);

        setInterval(() => {
            if (locationEnabled) fetchLocation(start);
        }, 30000);
    </script>
</body>
</html>
