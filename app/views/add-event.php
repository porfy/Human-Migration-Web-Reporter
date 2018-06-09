<!DOCTYPE html>
<html lang="en">
<head>
	<title>Human Migration Report Tool</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <<!-- Load Leaflet from CDN-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet-src.js"></script>

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@2.1.3"></script>

    <!-- Esri Leaflet Geocoder -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.9/dist/esri-leaflet-geocoder.css">
    <script src="https://unpkg.com/esri-leaflet-geocoder@2.2.8"></script>

</head>
<body class="body">

	<div class="top-nav">
		<img src="img/search.png" alt="search-icon" class="search-icon">
		<input type="text" placeholder="Search..">
	</div>

    <div class="side-nav">
        <a href="main"><img src="img/logo.png" alt="logo-icon" id="logo-icon"></a>
        <ul>
            <li><a href="user">My Profile</a></li>
            <li><a href="add-event">Add Event</a></li>
            <li><a href="export-data">Export Data</a></li>
            <li><a href="logout">Log out</a></li>
            <li><a href="contact">Contact Us</a></li>
        </ul>
    </div>

	<div class="main-content">


		<div class="form-content">
			<h1>ADD A NEW MIGRATION EVENT</h1>
			<h2>Complete the form below with details about the migration event</h2>

            <div id="map_event" style="width:600px; height: 400px;">
                <script>
                    var plecare, destinatie;

                    //initialize map
                    var map = new L.map('map_event').setView([0, 0], 2);
                    var geocodeService = L.esri.Geocoding.geocodeService();
                    var tiles = L.esri.basemapLayer("Streets").addTo(map);

                    // create the geocoding control and add it to the map
                    var searchControl1 = L.esri.Geocoding.geosearch().addTo(map);
                    var searchControl2 = L.esri.Geocoding.geosearch().addTo(map);

                    // create an empty layer group to store the results and add it to the map
                    var results = L.layerGroup().addTo(map);

                    // listen for the results event and add every result to the map
                    searchControl1.on("results", function(data) {
                        results.clearLayers();
                        plecare = data.results[0].latlng;
                        results.addLayer(L.marker(plecare));
                        geocodeService.reverse().latlng(plecare).run(function(error, result) {
                            document.getElementById("plecare").value = result.address.CountryCode;
                        })
                    });

                    searchControl2.on("results", function(data) {
                        results.clearLayers();
                        destinatie = data.results[0].latlng;
                        results.addLayer(L.marker(plecare));
                        results.addLayer(L.marker(destinatie));
                        geocodeService.reverse().latlng(destinatie).run(function(error, result) {
                            document.getElementById("destinatie").value = result.address.CountryCode;
                            })
                    });

                </script>
            </div>

			<div class="formular">
                <form action="event_submit" method="get">
                    <ul>
                        <li>Loc plecare: </li>
                        <li ><input type="text" id="plecare" name="loc_plecare"></li>

                        <li>Loc destinatie: </li>
                        <li><input type="text" id="destinatie" name="loc_destinatie"></li>

                        <li>Nr. adulti: </li>
                        <li><input type="text" name="nr_adulti"></li>

                        <li>Nr. copii: </li>
                        <li><input type="text" name="nr_copii"></li>

                        <li>Motiv: </li>
                        <li><input type="text" name="motiv"></li>

                        <li>Data eveniment: </li>
                        <li><input type="date" name="data_eveniment"></li>

                        <li>Descriere:</li>
                        <li><input type="text" name="descriere"></li>
                        <button type="submit" name="addEvent">Add Event</button>
                    </ul>
                </form>
			</div>

			<a href="main.html" id="back-button">Go back to the main page</a>
			
		</div>
	</div>
</body>
</html>