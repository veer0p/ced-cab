let map, searchManager, directionsManager;
let pickupMarker, dropoffMarker;

function getMaps() {
    // Initialize the map with default location (Ahmedabad)
    map = new Microsoft.Maps.Map('#dropoff-map', {
        credentials: 'Ak9O0_uk29mapIHmjtgj4MH_4dna5EQKlKAKoZtetwsEc7TxvUAJCPhEYmxwJ5CO',
        center: new Microsoft.Maps.Location(23.0225, 72.5714), // Coordinates for Ahmedabad
        zoom: 12 // Adjust the zoom level as needed
    });

    Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
        searchManager = new Microsoft.Maps.Search.SearchManager(map);
    });

    Microsoft.Maps.loadModule('Microsoft.Maps.Directions', function () {
        directionsManager = new Microsoft.Maps.Directions.DirectionsManager(map);
        directionsManager.setRenderOptions({ itineraryContainer: null }); // Disable rendering directions on the page
    }); 

    document.getElementById('pickup').addEventListener('input', function () {
        updateMap(this.value, 'pickup');
    });

    document.getElementById('drop').addEventListener('input', function () {
        updateMap(this.value, 'dropoff');
    });

    document.getElementById('button4').addEventListener('click', function () {
        if (pickupMarker && dropoffMarker) {
            calculateAndShowPath();
        } else {
            alert("Please enter both pickup and dropoff locations.");
        }
    });
}

function updateMap(location, type) {
    searchManager.geocode({
        where: location,
        callback: function (result) {
            if (result && result.results && result.results.length > 0) {
                let loc = result.results[0].location;
                if (type === 'pickup') {
                    if (pickupMarker) {
                        pickupMarker.setOptions({ visible: false });
                    }
                    pickupMarker = new Microsoft.Maps.Pushpin(loc, { draggable: false });
                    map.entities.push(pickupMarker);
                } else if (type === 'dropoff') {
                    if (dropoffMarker) {
                        dropoffMarker.setOptions({ visible: false });
                    }
                    dropoffMarker = new Microsoft.Maps.Pushpin(loc, { draggable: false });
                    map.entities.push(dropoffMarker);
                }
                map.setView({ center: loc, zoom: 14 }); // Adjust the zoom level as needed
                if (pickupMarker && dropoffMarker) {
                    calculateFare();
                }
            }
        }
    });
}

function calculateFare() {
    const distance = calculateDistance(pickupMarker.getLocation(), dropoffMarker.getLocation());
    const fare = Math.round(distance * 1); // Fare rate: 10 rupees per kilometer
    document.getElementById('f').value = fare;
}

function calculateAndShowPath() {
    const startLocation = pickupMarker.getLocation();
    const endLocation = dropoffMarker.getLocation();

    // Create waypoints array for any intermediate points, leave it empty if not needed
    const waypoints = [];

    // Add start and end waypoints
    directionsManager.clearAll();
    directionsManager.addWaypoint(new Microsoft.Maps.Directions.Waypoint({ location: startLocation }));
    directionsManager.addWaypoint(new Microsoft.Maps.Directions.Waypoint({ location: endLocation }));

    // Set options for the route calculation
    directionsManager.setRenderOptions({ itineraryContainer: document.getElementById('directions-container') }); // Enable rendering directions on the page

    // Calculate directions
    directionsManager.calculateDirections();
}

function calculateDistance(pickupLocation, dropoffLocation) {
    const pickupLat = pickupLocation.latitude * Math.PI / 180;
    const pickupLon = pickupLocation.longitude * Math.PI / 180;
    const dropoffLat = dropoffLocation.latitude * Math.PI / 180;
    const dropoffLon = dropoffLocation.longitude * Math.PI / 180;

    const earthRadius = 6371; // Earth's radius in kilometers

    const dLat = dropoffLat - pickupLat;
    const dLon = dropoffLon - pickupLon;

    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
              Math.cos(pickupLat) * Math.cos(dropoffLat) *
              Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

    const distance = earthRadius * c; // Distance in kilometers

    document.getElementById('f').value = distance.toFixed(2);

    return distance; // Return distance in kilometers
}

getMaps();
