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
	<meta charset="utf-8"/>e
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

    <script type="text/javascript" src="../app/models/chart/Chart.js"></script>

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
        <canvas id="myChart" width="400" height="200"></canvas>
        <script>
            var ctx = "myChart";

            var countries = Array();
            var numbers = Array();
            countries = [];
            numbers = [];

            function wait(ms){
                var start = new Date().getTime();
                var end = start;
                while(end < start + ms) {
                    end = new Date().getTime();
                }
            }

            function getXML(url) {
                return $.get(url)
            }

            wait(200);
            getXML('../app/models/firstChart.xml').done(function(xml) {
                var output = {};
                $(xml).find('info').each(function () {
                    var nodes = $(this).children();
                    $.each(nodes, function (i, node) {
                        var name = node.tagName;
                        var value = node.textContent;
                        output[name] = value;
                    });

                    countries.push(output['data']);
                    numbers.push(output['number']);
                });
            })

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: countries,
                    datasets: [{
                        label: 'Number of people',
                        data: numbers,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });



            setInterval(function() {
                    myChart.update();
                }, 1000);



        </script>
	</div>

</body>
</html>