<?php require_once("includes/DB.php") ?>
<?php require_once("includes/DateTime.php") ?>
<?php require_once("includes/Sessions.php") ?>
<?php require_once("includes/Functions.php") ?>
<?php
	if (isset($_POST["Submit"]))
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		if (empty($username) || empty($password))
		{
			$_SESSION["errorMessage"] = "All fields must be filled out.";
			//redirectTo("Login.php");
		}
		else
		{
			//echo "user: {$username} pass: {$password}";
			$admin = login($username, $password);
			//echo " admin: {$admin}";
			if ($admin)
			{
				echo "Worked";
				$_SESSION["currentUser"] = $username;
				$_SESSION["successMessage"] = "Welcome {$admin['username']} !";
				redirectTo("Dashboard.php");
			}
			else
			{
				echo "Did not work";
				$_SESSION["errorMessage"] = "Invalid Login !";
			}
		}
	}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="fontawesome/css/all.min.css" rel="stylesheet">
    <link href="fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="fontawesome/css/brands.css" rel="stylesheet">
    <link href="fontawesome/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="css/adminstyles.css">
    <link rel="stylesheet" href="css/publicstyles.css">
</head>
<body style="background: url(images/drop.jpg) no-repeat center center fixed; background-size: cover; margin-top: -36px; height: 100%">
<div style="height: 10px; background: rebeccapurple;"></div>
<nav class="navbar navbar-expand-lg navbar-default bg-white">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">


    </div>
</nav>
<div style="height: 10px; background: rebeccapurple;"></div>
<div class="container-fluid">
    <a href="Dashboard.php" class="navbar-brand offset-1 mt-5"><img src="images/logos/academyLogo2.png" alt="Logo" width="100"
                                                                    height="130"></a>
    <div class="row">

        <div class="offset-4 col-sm-4 align mt-5 pt-5">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h1 class="h1 h1-responsive card-title text-white font-weight-bold offset-3">Welcome Back !</h1>
            <div>

                <div><?php echo errorMessage();
						echo successMessage(); ?></div>
                <form action="Login.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label class="font-weight-bold fa-1x white-text" for="username">Username:</label>
                            <div class="input-group">
                                <span class="fas fa-user fa-2x text-white m-1 input-group-addon"></span>
                                <input class="form-control" type="text" name="username" id="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold fa-1x white-text"
                                   for="password">Password:</label>
                            <div class="input-group">
                                <span class="fas fa-lock fa-2x text-white m-1 input-group-addon"></span>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                            </div>
                        </div>
                        <input class="btn btn-info btn-block" type="Submit" name="Submit" value="Login">
                    </fieldset>
                    <br>
                </form>
            </div>

        </div>

    </div>
</div>

<script defer src="fontawesome/js/all.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>