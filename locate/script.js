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
    map.setView([lat, lng], 15);

    // Add a marker for the user's location
    L.marker([lat, lng]).addTo(map)
        .bindPopup("You are here!")
        .openPopup();
}

// Function to handle errors
function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("User  denied the request for Geolocation.");
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

// Call the getLocation function to retrieve the user's location
getLocation();