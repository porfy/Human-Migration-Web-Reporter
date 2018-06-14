<?php
    session_start();
    if(!isset($_SESSION['loged_in'])){
        header('Location: login');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Human Migration Report Tool</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <!-- Load Leaflet from CDN-->
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
		<div class="content">
			<h1>MIGRATION OVERVIEW</h1>
			<article class="topcontent">
				<header>
					<h2><a href="#" title="First post">Migration 1</a></h2>
					<h3 class="align-right">posted by @anonymous</h3>
				</header>
					<div id="mapid" style="width:1000px; height: 600px;">
						<script>

                            var map = new L.map('mapid').setView([0, 0], 2);
                            var geocodeService = L.esri.Geocoding.geocodeService();
                            var tiles = L.esri.basemapLayer("Gray").addTo(map);
                            var results = L.layerGroup().addTo(map);

                            var latlngs = Array();

                            function getXML(url) {
                                return $.get(url)
                            }

                            getXML('../app/models/migration.xml').done(function(xml){
                                var output = {}; // restructure the xml as an object
                                $(xml).find('post').each(function() {
                                    var nodes = $(this).children();
                                    $.each(nodes, function(i,node){
                                        var name = node.tagName;
                                        var value = node.textContent;
                                        output[name] = value;
                                    });
                                    // build markers from the output and add to the map
                                    var geoPlecare = L.esri.Geocoding.geocode().text(output['loc_plecare']).run(function(err, rezultat, response){
                                        markerPlecare = L.marker(rezultat.results[0].latlng);
                                        var popupContent = output['descriere']; //probleme aici apare doar descrierea la ultima migrare
                                        markerPlecare.bindPopup(popupContent)
                                        results.addLayer(markerPlecare);
                                        latlngs.push(markerPlecare.getLatLng());
                                    });

                                    var geoDestinatie = L.esri.Geocoding.geocode().text(output['loc_destinatie']).run(function(err, rezultat, response){
                                        markerDestinatie = L.marker(rezultat.results[0].latlng);
                                        var popupContent = output['descriere']; //probleme aici apare doar descrierea la ultima migrare
                                        markerDestinatie.bindPopup(popupContent)
                                        results.addLayer(markerDestinatie);
                                        latlngs.push(markerDestinatie.getLatLng());

                                        polyline = L.polyline(latlngs, {color: 'blue', weight:3, opacity:0.5, smoothFactor: 1});
                                        polyline.addTo(map);
                                        latlngs = []; //clear
                                    });


                                });
                            })


						</script>
					</div>
					<ul>
						<li>Migration from Romania</li>
						<li>12 March 2018</li>
						<li>From Romania to Italia</li>
					</ul>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla cursus maximus fermentum. In posuere turpis vitae ante egestas, sit amet cursus elit molestie. Morbi mattis scelerisque enim. Ut a urna nunc. Duis cursus, nisl non viverra sodales, justo tellus condimentum mauris, et mollis erat eros eu nisi. Donec id lacus lacus. Suspendisse interdum porttitor lectus, eu malesuada ligula tempor ac. Praesent tincidunt dui mi, quis tincidunt sem lobortis ac. Maecenas iaculis sapien et maximus feugiat. Etiam ultricies, velit vel sodales rhoncus, risus ligula feugiat est, sit amet tempus tortor massa vitae diam. Quisque vel est turpis. Vestibulum consequat consequat leo id placerat. Vivamus ultricies malesuada eleifend. Aliquam quis bibendum metus, varius dignissim enim. Mauris eget enim sed justo scelerisque ultrices quis vel mauris.</p>
					<a href="#">
						<p class="align-right">Share on Facebook</p>
					</a>

			</article>
		</div>
	</div>

<!--<script>
function myMap() {
    var mapOptions = {
        center: new google.maps.LatLng(51.5, -0.12),
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.HYBRID
    }
var map = new google.maps.Map(document.getElementById("map"), mapOptions);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfKb6AcjpjTTPhzjAmMaCB5vX59WBWdls&callback=myMap"></script>-->

</body>
</html>