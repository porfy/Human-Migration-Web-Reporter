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
        <canvas id="firstChart" width="400" height="200"></canvas>
        <script>
            var ctx = "firstChart";
            var countries = Array();
            var num= Array();
            countries = [];
            num = [];

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
                    num.push(output['number']);
                });
            })

            var firstChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: countries,
                    datasets: [{
                        label: 'Number of people',
                        data: num,
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
                    firstChart.update();
                }, 1000);
        </script>
        <canvas id="secondChart" width="400" height="200"></canvas>
        <script>
            var ctx="secondChart";
            var motive = Array();
            var nr_motive = Array();
            var color=Array();
            color=[];
            motive = [];
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
            getXML("../app/models/secondChart.xml").done(function(xml) {
                var output = {};
                $(xml).find('info').each(function () {
                    var nodes = $(this).children();
                    $.each(nodes, function (i, node) {
                        var name = node.tagName;
                        var value = node.textContent;
                        output[name] = value;
                    });

                    motive.push(output['motiv']);
                    nr_motive.push(output['number']);
                });
            });
            chart2=new Chart(document.getElementById(ctx), {
            type: 'doughnut',
                data: {
                labels: motive,
                    datasets: [
                    {
                        label: motive,
                        backgroundColor:["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: nr_motive
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                        text: 'Nr. Migrari dupa motiv'
                }
            }
            });

            setInterval(function() {
                chart2.update();
            }, 1000);
        </script>
        <canvas id="third-chart" width="400" height="200"></canvas>
        <script>
            var ctx="third-chart";
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
            char3=new Chart(document.getElementById(ctx), {
            type: 'line',
            data: {
                labels: [1500, 1600, 1700, 1750, 1800, 1850, 1900, 1950, 1999, 2050],
                datasets: [
                    {
                        data: [86, 114, 106, 106, 107, 111, 133, 221, 783, 2478],
                        label: "Children",
                        borderColor: "#3e95cd",
                        fill: false
                    }
                    ]
                 },
                options: {
                title: {
                    display: true,
                        text: 'Child migration '
                }
            }
            });
        </script>
    </div>
</body>
</html>