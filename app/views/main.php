<?php
    session_start();
    if (!isset($_SESSION['loged_in'])) {
        header('Location: login');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Human Migration Report Tool TEST costl</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width" , initial-scale="1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <!-- Load Leaflet from CDN-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet-src.js"></script>

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@2.1.3"></script>

    <!-- Esri Leaflet Geocoder -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.9/dist/esri-leaflet-geocoder.css">
    <script src="https://unpkg.com/esri-leaflet-geocoder@2.2.8"></script>

</head>
<body class="body">

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
        <h1>ALL MIGRATION OVERVIEW</h1>
        <article class="topcontent">
            <div id="map_event">
                <script>

                    var map = new L.map('map_event').setView([0, 0], 2);
                    var geocodeService = L.esri.Geocoding.geocodeService();
                    var tiles = L.esri.basemapLayer("Streets").addTo(map);
                    var results = L.layerGroup().addTo(map);

                    //var geoPlecare, geoDestinatie;

                    function wait(ms) {
                        var start = new Date().getTime();
                        var end = start;
                        while (end < start + ms) {
                            end = new Date().getTime();
                        }
                    }

                    function getXML(url) {
                        return $.get(url)
                    }

                    function getRandomColor() {
                        var letters = '0123456789ABCDEF';
                        var color = '#';
                        for (var i = 0; i < 6; i++) {
                            color += letters[Math.floor(Math.random() * 16)];
                        }
                        return color;
                    }

                    var icons = {
                        departure: L.icon({
                            iconUrl: '../public/img/departure_icon.svg',
                            iconSize: [27, 31],
                            iconAnchor: [13.5, 17.5],
                            popupAnchor: [0, -11],
                        }),
                        destination: L.icon({
                            iconUrl: '../public/img/destination_icon.svg',
                            iconSize: [27, 31],
                            iconAnchor: [13.5, 13.5],
                            popupAnchor: [0, -11],
                        }),
                    };

                    wait(200);
                    getXML('../public/xml/migration.xml').done(function (xml) {
                        results.clearLayers();

                        var output = {};
                        $(xml).find('post').each(function () {
                            var nodes = $(this).children();
                            $.each(nodes, function (i, node) {
                                var name = node.tagName;
                                var value = node.textContent;
                                output[name] = value;
                            });

                            //exemplu 012.666666 + 0.000101 si 0.000999
                            var random = (Math.floor(Math.random() * 999) + 500) / 10000;


                            var descriere = output['descriere'];
                            var nr_copii = output['nr_copii'];
                            var nr_adulti = output['nr_adulti'];
                            var dataplecare = output['dataplecare'];
                            var motiv = output['motiv'];

                            var lat_plec = parseFloat(output['lat_plec']) + random;
                            var lng_plec = parseFloat(output['lng_plec']) + random;
                            var lat_dest = parseFloat(output['lat_dest']) + random;
                            var lng_dest = parseFloat(output['lng_dest']) + random;

                            var latlngs_plec = Array();
                            latlngs_plec.push(lat_plec);
                            latlngs_plec.push(lng_plec);
                            var markerPlecare = L.marker(latlngs_plec, {icon: icons['departure']});
                            results.addLayer(markerPlecare);

                            var latlngs_dest = Array();
                            latlngs_dest.push(lat_dest);
                            latlngs_dest.push(lng_dest);
                            var markerDest = L.marker(latlngs_dest, {icon: icons['destination']});
                            results.addLayer(markerDest);

                            var latlngs = Array();
                            latlngs.push(latlngs_plec);
                            latlngs.push(latlngs_dest);

                            polyline = L.polyline(latlngs, {
                                color: getRandomColor(),
                                weight: 6,
                                opacity: 0.9,
                                smoothFactor: 1
                            });
                            polyline.bindPopup("Descriere: " + descriere + "</br>Numar copii: " + nr_copii + "</br>Numar adulti: " + nr_adulti + "</br>Data migrare: " + dataplecare + "</br>Motiv: " + motiv);
                            polyline.addTo(map);

                        })

                    });

                </script>

            </div>
        </article>
    </div>
</div>
</body>
</html>