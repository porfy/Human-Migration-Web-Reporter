
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="register.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

	<div class="welcome">
		<h1>Join our community</h1>
	</div>
	<form action="register-submit" method="POST">
		<div class="register-box" >
			<h1>Sign up</h1>
            <div class="error">
                <?php
                    if(isset($_SESSION['error'])){
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                ?>
            </div>
			<p>First name</p>
			<input type="text" name="first" placeholder="Name">

			<p>Last name</p>
			<input type="text" name="last" placeholder="Name">

			<p>Country</p>
			<input type="text" name="country" placeholder="Country">

			<p>Username</p>
			<input type="text" name="username" placeholder="Username">

			<p>Email address</p>
			<input type="email" name="email" placeholder="Email">

			<p>Password</p>
			<input type="password" name="pwd" placeholder="Password">

			<button type="submit" name="submit"> Signup</button>

			<a href="login.html"><em>Already have an account here?</em></a>
			<a href="intro.html"><em>Go back</em></a>
		</div>
	</form>
</body>
</html>