<?php 
    require('inc/functions.php');
    session_start();
    if (!(isset($_SESSION['user_id']) && $_SESSION['logged_in'] == true)) {
        checkuser();
        exit;
    }
    
    session_regenerate_id(true);
?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Live Location</title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
</head>
<body class="bg-light">

    <?php require('inc/header.php'); ?>
    <div id="toast" style="
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #333;
        color: white;
        padding: 15px 20px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        font-size: 16px;
        display: none;
        z-index: 9999;">
        You must be logged in to access this page.
    </div>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">LIVE LOCATION</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container my-5 text-center">
        <div class="form-group">
            <label for="busSelect" class="form-label">Select Bus:</label>
            <select id="busSelect" class="form-control" onchange="fetchLocation()">
                <option value="">Select a Bus</option>
                <option value="all">All Buses</option>
                <?php
                    // Fetch buses from the database
                    include 'inc/config.php';
                    $result = $conn->query("SELECT bus_id, bus_number FROM bus_info");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['bus_id']}'>{$row['bus_number']}</option>";
                    }
                ?>
            </select>
        </div>
        <br><br>
        <div id="mapContainer" style="height: 500px; width: 100%;"></div>
    </div>

    <?php require('inc/footer.php'); ?>

    <script>
        var platform = new H.service.Platform({
            'apikey': '36508bwns8rxJNRNqbpp8TeEfvUYY9tIOou_X6yTvEo'
        });

        var defaultLayers = platform.createDefaultLayers();
        // Initialize the map with a default view
        const map = new H.Map(
            document.getElementById('mapContainer'),
            defaultLayers.raster.satellite.map, // Use the satellite map layer
            {
                zoom: 13, // Default zoom level
                center: { lat: 25.5937, lng: 84.9629 } // Default center (e.g., India)
            }
        );


        var mapEvents = new H.mapevents.MapEvents(map);
        var behavior = new H.mapevents.Behavior(mapEvents);
        var ui = H.ui.UI.createDefault(map, defaultLayers);

        var markers = [];

        function fetchLocation() {
            var busId = document.getElementById('busSelect').value;

            // Clear all markers safely
            if (markers.length > 0) {
                markers.forEach(marker => {
                    try {
                        if (map.getObjects().includes(marker)) {
                            map.removeObject(marker);
                        }
                    } catch (e) {
                        console.error('Error removing marker:', e);
                    }
                });
                markers = [];
            }

            if (!busId){
                map.setCenter({ lat: 25.5937, lng: 84.9629 }); // Default center (e.g., India)
                map.setZoom(13); // Default zoom level
                return;
            }

            if (busId === "all") {
                // Fetch all bus locations
                $.ajax({
                    url: 'ajax/fetch_all_locations.php',
                    method: 'POST',
                    success: function (response) {
                        var buses = JSON.parse(response);

                        console.log(buses);

                        var group = new H.map.Group();

                        buses.forEach(bus => {
                            if (bus.latitude && bus.longitude) {
                                var coordinates = { lat: bus.latitude, lng: bus.longitude };

                                var icon = new H.map.Icon('./images/bus_pin.png', { 
                                    size: { w: 32, h: 32 }, // Customize size as needed 
                                });
                                var marker = new H.map.Marker(coordinates, { icon: icon });

                                // Add info bubble
                                marker.setData(`Bus : ${bus.bus_id}<br>Location: (${bus.latitude}, ${bus.longitude})`);
                                marker.addEventListener('tap', function (evt) {
                                    var bubble = new H.ui.InfoBubble(evt.target.getGeometry(), {
                                        content: evt.target.getData()
                                    });
                                    ui.addBubble(bubble);
                                });

                                markers.push(marker); // Track marker
                                
                                group.addObject(marker); // Add marker to group
                            }
                        });

                        map.addObject(group); // Add group to map
                        

                        if (buses.length > 0) {
                            map.getViewModel().setLookAtData({ bounds: group.getBoundingBox() });
                            map.setZoom(14);
                        }
                    },
                    error: function () {
                        alert('Failed to fetch bus locations');
                    }
                });
            } else {
                // Fetch single bus location
                $.ajax({
                    url: 'ajax/fetch_location.php',
                    method: 'POST',
                    data: { bus_id: busId },
                    success: function (response) {
                        var data = JSON.parse(response);

                        if (data.lat && data.lng) {
                            var coordinates = { lat: data.lat, lng: data.lng };

                            // Create custom icon
                            var icon = new H.map.Icon('./images/bus_pin.png', { 
                                size: { w: 32, h: 32 }, // Customize size as needed 
                            });
                            var marker = new H.map.Marker(coordinates, { icon: icon });

                            // Add info bubble
                            marker.setData(`Bus : ${data.bus_id}<br>Location: (${data.lat}, ${data.lng})`);
                            marker.addEventListener('tap', function (evt) {
                                var bubble = new H.ui.InfoBubble(evt.target.getGeometry(), {
                                    content: evt.target.getData()
                                });
                                ui.addBubble(bubble);
                            });

                            markers.push(marker); // Track marker
                            map.addObject(marker); // Add marker to map
                            map.setCenter(coordinates); // Center map on the selected bus
                            map.setZoom(16); 
                        }
                    },
                    error: function () {
                        alert('Failed to fetch location');
                    }
                });
            }
        }


    </script>
</body>
</html>
