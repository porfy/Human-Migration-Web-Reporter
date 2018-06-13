<<<<<<< HEAD
<!DOCTYPE html>
<html>

	<head>
		<title>Login Human Migration Web Reporter</title>
		<link rel="stylesheet" type="text/css" href="login.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>

		<div class="login-box">
            <div class="error">
                <?php
                if(isset($_SESSION['Error'])){
                    Echo $_SESSION['Error'];
                    unset($_SESSION['Error']);
                }
                ?>
            </div>
			<a href="main.html"><img src="img/user.png" alt="" class="avatar"></a>
			<h1>Login</h1>

            <form action="login-submit" method="POST">

				<p>Username</p>
				<input type="text" name="username" placeholder="Enter username" required>
				<p>Password</p>
				<input type="password" name="password" placeholder="Enter password" required>
				<button type="submit" name="submit">Login</button>
				<a href="#"> Forget Password?</a>
				<a href="intro.html">Go Back</a>
			</form>
		</div>
	</body>
=======
<!DOCTYPE html>
<html>

	<head>
		<title>Login Human Migration Web Reporter</title>
		<link rel="stylesheet" type="text/css" href="login.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>

		<div class="login-box">
            <div class="error">
                <?php
                if(isset($_SESSION['Error'])){
                    Echo $_SESSION['Error'];
                    Echo $_SESSION['Time'];
                    unset($_SESSION['Error']);
                    unset($_SESSION['Time']);
                }
                ?>
            </div>
			<a href="main.html"><img src="img/user.png" alt="" class="avatar"></a>
			<h1>Login</h1>

            <form action="login-submit" method="POST">

				<p>Username</p>
				<input type="text" name="username" placeholder="Enter username" required>
				<p>Password</p>
				<input type="password" name="password" placeholder="Enter password" required>
				<button type="submit" name="submit">Login</button>
				<a href="#"> Forget Password?</a>
				<a href="intro.html">Go Back</a>
			</form>
		</div>
	</body>
>>>>>>> f95e207c517a27d72ee9271816deaf091e724a1d
</html>