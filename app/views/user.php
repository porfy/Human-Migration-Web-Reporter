<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['loged_in'])){
    header('Location: login');
}
?>
<!Doctype html>
<html lang="en">
<head>
	<title>Human Migration Report Tool</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="body">

	<div class="top-nav">
        <!--<img src="img/search.png" alt="search-icon" class="search-icon">
<input type="text" placeholder="Search..">-->
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
		<div class="user-content">
			<h1>WELCOME, USER!</h1>
			<h2>About you</h2>
			<a href="main.html"><img src="img/user.png" alt="user-icon" class="avatar"></a>
			<ul>
                <li>Full name:<?php
                    echo $_SESSION['nume']." ".$_SESSION['prenume'];
                    ?></li>
                <li>Country: <?php
                    echo $_SESSION['tara'];
                    ?></li>
                <li>Email address: <?php
                    echo $_SESSION['email'];
                    ?></li>
                <li>Number of posts: <?php
                    echo $_SESSION['nr_postari'];
                    ?></li>
			</ul>
			<a href="main" id="back-button">Go back to the main page</a>
			
		</div>
	</div>
</body>
</html>