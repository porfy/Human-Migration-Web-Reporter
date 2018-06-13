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
    <script type="text/javascript" src="leaflet/leaflet.js"></script>
    <link rel="stylesheet" type="text/css" href="leaflet/ControlGeocoder.css">
    <link rel="stylesheet" type="text/css" href="leaflet/leaflet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="body">

	<div class="top-nav">
        <?php
         echo $_SESSION['loged_in'];
        ?>
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
			<h1>MIGRATION NEWSFEED</h1>
			<article class="topcontent">
				<header>
					<h2><a href="#" title="First post">Migration 1</a></h2>
					<h3 class="align-right">posted by @anonymous</h3>
				</header>
					<div id="mapid" style="width:600px; height: 400px;">
						<script>
							var mymap = L.map('mapid').setView([0, 0], 2);
							L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
								maxZoom: 18,
								attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
								'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
								'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
								id: 'mapbox.streets'
							}).addTo(mymap);

							var geocoder = L.Control.geocoder()
								.on('markgeocode', function (event) {
									var center = event.geocode.center;
									L.marker(center).addTo(mymap);
									map.setView(center, map.getZoom())
								})
								.addTo(mymap);

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
			<article class="topcontent">
				<header>
					<h2><a href="#" title="First post">Migration 2</a></h2>
					<h3 class="align-right">posted by @anonymous</h3>
				</header>

					<img src="img/map.png" alt="map-photo" class="map-photo">
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
			<article class="topcontent">
				<header>
					<h2><a href="#" title="First post">Migration 3</a></h2>
					<h3 class="align-right">posted by @anonymous</h3>
				</header>

					<img src="img/map.png" alt="map-photo" class="map-photo">
					<ul>
						<li>The great event</li>
						<li>26 January 2018</li>
						<li>From Spain to Italia</li>
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