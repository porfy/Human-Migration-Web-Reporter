<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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

    <!-- Load Leaflet from CDN-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet-src.js"></script>

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@2.1.3"></script>

    <!-- Esri Leaflet Geocoder -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.9/dist/esri-leaflet-geocoder.css">
    <script src="https://unpkg.com/esri-leaflet-geocoder@2.2.8"></script>

    <script src="leaflet/leaflet.ajax.min.js"></script>

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
        <div class="error">
            <?php
                if(isset($_SESSION['error'])){
                    Echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
        </div>
        <div id="map_event">
            <script>
                var plecare, destinatie;
                var map = new L.map('map_event').setView([0, 0], 2);
                var geocodeService = L.esri.Geocoding.geocodeService();
                var tiles = L.esri.basemapLayer("Gray").addTo(map);
                var searchControlPlecare = L.esri.Geocoding.geosearch({expanded:true, placeholder:'migration origin', position: 'topright'}).addTo(map);
                var searchControlDestinatie = L.esri.Geocoding.geosearch({expanded:true, placeholder:'migration destination', position: 'topright'}).addTo(map);
                var results = L.layerGroup().addTo(map);

                searchControlPlecare.on("results", function(data) {
                    results.clearLayers();
                    plecare = data.results[0].latlng;
                    results.addLayer(L.marker(plecare));
                    geocodeService.reverse().latlng(plecare).run(function(error, result) {
                        document.getElementById("plecare").value = result.address.CountryCode;
                    })
                });

                searchControlDestinatie.on("results", function(data) {
                    results.clearLayers();
                    destinatie = data.results[0].latlng;
                    results.addLayer(L.marker(plecare));
                    results.addLayer(L.marker(destinatie));
                    geocodeService.reverse().latlng(destinatie).run(function(error, result) {
                        document.getElementById("destinatie").value = result.address.CountryCode;
                    })
                });

                //GEOCODE BY COUNTRYCODE TEXT
                var latlngs = Array();
                var locc1 = 'FRA';
                var locc2 = 'ROU';
                var locc1_marker, locc2_marker;

                var test = L.esri.Geocoding.geocode().text(locc1).run(function(err, rezultat, response){
                    locc1_marker = L.marker(rezultat.results[0].latlng);
                    results.addLayer(locc1_marker);
                    latlngs.push(locc1_marker.getLatLng());
                });

                var test2 = L.esri.Geocoding.geocode().text(locc2).run(function(err, rezultat, response){
                    locc2_marker = L.marker(rezultat.results[0].latlng);
                    results.addLayer(locc2_marker);
                    latlngs.push(locc2_marker.getLatLng());
                    var polyline = L.polyline(latlngs, {color: 'blue', weight:3, opacity:0.5, smoothFactor: 1});
                    polyline.addTo(map);
                });




                //add instructions
                var addInstructions = function(map) {
                    var info = L.control({position: 'topright'});

                    info.onAdd = function (map) {
                        this._div = L.DomUtil.create('div', 'info leaflet-bar'); // create a div with a class "info"
                        this.update();
                        return this._div;
                    };

                    // method that we will use to update the control based on feature properties passed
                    info.update = function (props) {
                        this._div.innerHTML = '<div class="formular">\n' +
                            '            <form action="event_submit" method="post">\n' +
                            '                <ul>\n' +
                            '                    <li>Loc plecare: </li>\n' +
                            '                    <li><input type="text" id="plecare" name="loc_plecare"></li>\n' +
                            '                    <li>Loc destinatie: </li>\n' +
                            '                    <li><input type="text" id="destinatie" name="loc_destinatie"></li>\n' +
                            '                    <li>Nr. adulti: </li>\n' +
                            '                    <li><input type="text" name="nr_adulti"></li>\n' +
                            '                    <li>Nr. copii: </li>\n' +
                            '                    <li><input type="text" name="nr_copii"></li>\n' +
                            '                    <li>Motiv: <select name="motiv">' +
                            '                           <option value="economic">economic</option>' +
                            '                           <option value="razboi">razboi</option>' +
                            '                           <option value="dezastre naturale">dezastre naturale</option>' +
                            '                           <option value="altul">altul</option>' +
                            '                           <option value="social politic">social-politic</option></select></li>\n' +
                            '                    <li>Data eveniment: </li>\n' +
                            '                    <li><input type="date" name="data_eveniment"></li>\n' +
                            '                    <li>Descriere:</li>\n' +
                            '                    <li><input type="text" name="descriere"></li>\n' +
                            '                    <button type="submit" name="submit">Add Event</button>\n' +
                            '                </ul>\n' +
                            '            </form>\n' +
                            '        </div>';
                    };
                    info.addTo(map);
                }

                addInstructions(map);
            </script>
        </div>
    </div>
    <a href="main.html" id="back-button">Go back to the main page</a>
</div>
</body>
</html>