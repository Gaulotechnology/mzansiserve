<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions Service (Complex)</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #warnings-panel {
        width: 100%;
        height:10%;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div id="floating-panel">
    <b>Start: </b>
    <select id="start">
      <option value="Johannesburg">Johannesburg</option>
      <option value="grand central station, new york, ny">Grand Central Station</option>
      <option value="625 8th Avenue, New York, NY, 10018">Port Authority Bus Terminal</option>
      <option value="staten island ferry terminal, new york, ny">Staten Island Ferry Terminal</option>
      <option value="101 E 125th Street, New York, NY">Harlem - 125th St Station</option>
    </select>
    <b>End: </b>
    <select id="end">
      <option value="Cosmo city">Cosmo City</option>
      <option value="Sandton">Sandton</option>
      <option value="moma, New York, NY">MOMA</option>
      <option value="350 5th Ave, New York, NY, 10118">Empire State Building</option>
      <option value="253 West 125th Street, New York, NY">Apollo Theater</option>
      <option value="1 Wall St, New York, NY">Wall St</option>
    </select>
    </div>
    <div id="map"></div>
    &nbsp;
    <div id="warnings-panel"></div>
    <script>
      function initMap() {
        var markerArray = [];

        // Instantiate a directions service.
        var directionsService = new google.maps.DirectionsService;

        // Create a map and center it on Manhattan.
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 40.771, lng: -73.974}
        });

        // Create a renderer for directions and bind it to the map.
        var directionsDisplay = new google.maps.DirectionsRenderer({map: map});

        // Instantiate an info window to hold step text.
        var stepDisplay = new google.maps.InfoWindow;

        // Display the route between the initial start and end selections.
        calculateAndDisplayRoute(
            directionsDisplay, directionsService, markerArray, stepDisplay, map);
        // Listen to change events from the start and end lists.
        var onChangeHandler = function() {
          calculateAndDisplayRoute(
              directionsDisplay, directionsService, markerArray, stepDisplay, map);
        };
        document.getElementById('start').addEventListener('change', onChangeHandler);
        document.getElementById('end').addEventListener('change', onChangeHandler);
      }

      function calculateAndDisplayRoute(directionsDisplay, directionsService,
          markerArray, stepDisplay, map) {
        // First, remove any existing markers from the map.
        for (var i = 0; i < markerArray.length; i++) {
          markerArray[i].setMap(null);
        }

        // Retrieve the start and end locations and create a DirectionsRequest using
        // WALKING directions.
        directionsService.route({
          origin: document.getElementById('start').value,
          destination: document.getElementById('end').value,
          travelMode: 'DRIVING'
        }, function(response, status) {
          // Route the directions and pass the response to a function to create
          // markers for each step.
          if (status === 'OK') {
            document.getElementById('warnings-panel').innerHTML =
                '<b>' + response.routes[0].warnings + '</b>';
            directionsDisplay.setDirections(response);
            showSteps(response, markerArray, stepDisplay, map);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }

      function showSteps(directionResult, markerArray, stepDisplay, map) {
        // For each step, place a marker, and add the text to the marker's infowindow.
        // Also attach the marker to an array so we can keep track of it and remove it
        // when calculating new routes.
        var myRoute = directionResult.routes[0].legs[0];
        for (var i = 0; i < myRoute.steps.length; i++) {
          var marker = markerArray[i] = markerArray[i] || new google.maps.Marker;
          marker.setMap(map);
          marker.setPosition(myRoute.steps[i].start_location);
          attachInstructionText(
              stepDisplay, marker, myRoute.steps[i].instructions, map);
        }
      }

      function attachInstructionText(stepDisplay, marker, text, map) {
        google.maps.event.addListener(marker, 'click', function() {
          // Open an info window when the marker is clicked on, containing the text
          // of the step.
          stepDisplay.setContent(text);
          stepDisplay.open(map, marker);
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2fZA6EQJe-qaGwnWFmEfI9ytECYC-BNY&callback=initMap">
    </script>
  </body>
</html>