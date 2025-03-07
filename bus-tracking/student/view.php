<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../inc/links.php"; ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
    <script>
        let map, marker;

        function initMap() {
            const mapOptions = {
                zoom: 15,
                center: { lat: 0, lng: 0 }
            };
            map = new google.maps.Map(document.getElementById('map'), mapOptions);
        }

        function fetchLocation() {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "../functions/tracking.php?bus_id=1", true);
            xhr.onload = function () {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    const lat = parseFloat(response.latitude);
                    const long = parseFloat(response.longitude);

                    const position = { lat: lat, lng: long };
                    if (marker) {
                        marker.setPosition(position);
                    } else {
                        marker = new google.maps.Marker({ position: position, map: map });
                    }
                    map.setCenter(position);
                }
            };
            xhr.send();
        }

        setInterval(fetchLocation, 5000); // Update location every 5 seconds

        window.onload = initMap;
    </script>
</head>
<body>
    <?php include "../inc/header.php"; ?>
    <div id="map" style="height: 400px; width: 100%;"></div>
    <?php include "../inc/footer.php"; ?>
</body>
</html>
