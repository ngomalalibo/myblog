<?php require_once("includes/DB.php") ?>
<?php require_once("includes/DateTime.php") ?>
<?php require_once("includes/Sessions.php") ?>
<?php require_once("includes/Functions.php") ?>

<?php //confirmLogin(); ?>
<?php
	$currentTime = datetime();
	if (isset($_POST["Submit"]))
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$conpassword = $_POST["confirmpassword"];
		
		if (empty($username) || empty($password) || empty($conpassword))
		{
			$_SESSION["errorMessage"] = "All fields must be filled out.";
			redirectTo("Admins.php");
		}
		else if (strlen($password) < 4)
		{
			$_SESSION["errorMessage"] = "Password should be at least 4 characters.";
			redirectTo("Admins.php");
		}
		else if (!($password === $conpassword))
		{
			$_SESSION["errorMessage"] = "Password and confirm password fields should match !";
			redirectTo("Admins.php");
		}
		else
		{
			global $connection;
			$query = "insert into admins(datetime, username, password, addedby)";
			$query .= "values(:datetime, :username, :password, :addedby)";
			$stmt = $connection->prepare($query);
			$stmt->bindValue(':datetime', datetime());
			$stmt->bindValue(':username', $username);
			$stmt->bindValue(':password', $password);
			$stmt->bindValue(':addedby', "Ngo Alalibo");
			$Execute = $stmt->execute();
			if ($Execute)
			{
				$_SESSION["successMessage"] = "Admin added Successfully";
				redirectTo("Admins.php");
			}
			else
			{
				$_SESSION["errorMessage"] = "Something went wrong. Try Again !";
				redirectTo("Admins.php");
			}
		}
	}

?>
<!doctype>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admins</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/adminstyles.css">
    <link href="fontawesome/css/all.min.css" rel="stylesheet">
    <link href="fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="fontawesome/css/brands.css" rel="stylesheet">
    <link href="fontawesome/css/solid.css" rel="stylesheet">
</head>
<body>
<div style="height: 10px; background: rebeccapurple;"></div>
<nav class="navbar navbar-expand-lg navbar-default bg-light">
    <a href="Dashboard.php" class="navbar-brand"> <img src="images/logos/Logo.png" alt="Logo" width="250"
                                                       height="75"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active btn btn-dark btn-sm"><a class="nav-link" href="Blog.php">Blog Home<span
                            class="sr-only">(current)</span></a></li>
            <!--<li class="nav-item"><a class="nav-link" href="#">Home</a></li>-->
            <!--<li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Feature</a></li>-->
        </ul>
    </div>
</nav>
<div style="height: 10px; background: rebeccapurple;"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <br>
            <h4 class="text-white">Ngo Alalibo's Blog</h4>
            <br>
            <ul id="Side_Menu" class="nav nav-pills d-block">
                <li class="nav-item"><span class="fas fa-th text-warning mx-2"></span><a
                            href="Dashboard.php">Dashboard</a></li>
                <li class="nav-item active"><span class="fas fa-plus-square text-warning mx-2"></span><a href="AddNewPost.php">Add
                        New
                        Post</a>
                </li>
                <li class="nav-item"><span class="fas fa-user text-warning mx-2"></span><a
                            href="#">Categories</a></li>
                <li class="nav-item"><span class="far fa-user text-warning mx-2"></span><a href="Admins.php">Manage Admins</a>
                </li>
                <li class="nav-item"><span class="fal fa-user text-warning mx-2"></span><a href="Comments.php">Comments</a>
					
					<?php
						$noOfComments = getAllUnapprovedComments();
						if ($noOfComments > 0)
						{
							?>
                            <span class="badge-pill badge-warning ml-1 small fa-pull-right"><?php echo $noOfComments; ?> </span>
						<?php } ?>
                </li>
                <li class="nav-item"><span class="fab fa-github-square text-warning mx-2"></span><a href="Blog.php" target="_blank">Live
                        Blog</a>
                </li>
                <li class="nav-item"><span class="fas fa-sign-out-alt text-warning mx-2"></span><a href="Logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-10">
            <br>
            <h1>Manage Admins</h1>
            <div>
                <div><?php echo errorMessage();
						echo successMessage(); ?></div>
                <form action="Admins.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label class="purple-text"
                                   for="username">Username:</label>
                            <input class="form-control" type="text" name="username" id="username"
                                   placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label class="purple-text"
                                   for="password">Password:</label>
                            <input class="form-control" type="password" name="password" id="password"
                                   placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label class="purple-text"
                                   for="confirmpassword">Confirm Password:</label>
                            <input class="form-control" type="password" name="confirmpassword" id="confirmpassword"
                                   placeholder="Retype same Password">
                        </div>

                        <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Admin">
                    </fieldset>
                    <br>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th>Sr No</th>
                        <th>Date & Time</th>
                        <th>Username</th>
                        <th>Created By</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php
						global $connection;
						$viewQuery = "select * from admins order by datetime desc";
						$execute = $connection->query($viewQuery);
						$srno = 0;
						
						while ($dataRows = $execute->fetch())
						{
							$Id = $dataRows["id"];
							$username = $dataRows["username"];
							$dateTime = $dataRows["datetime"];
							$addedby = $dataRows["addedby"];
							$srno++
							
							?>

                            <tr>
                                <td><?php echo $srno; ?></td>
                                <td><?php echo $dateTime; ?></td>
                                <td><?php echo $username; ?></td>
                                <td><?php echo $addedby; ?></td>
                                <td><a class="btn btn-danger btn-sm" href="DeleteAdmin.php?id=<?php echo $Id; ?>">Delete</a></td>
                            </tr>
						<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<div class="bg-dark" id="footer">
    <hr>
    <p>Nog Alalibo's Blog by Ngo Alalibo | &copy; 2020</p>
    <a href="#" style="color:white; text-decoration: none; cursor: pointer; font-weight: bold"></a>
    <p>This is a live blog. Th truth is the most valuable thing on earth. I hope that this blog makes you a more valuable person as you read and interact with the posts.</p>
</div>
<div style="height: 10px; background: rebeccapurple;"></div>
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