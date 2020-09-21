<?php require_once("includes/DB.php") ?>
<?php require_once("includes/DateTime.php") ?>
<?php require_once("includes/Sessions.php") ?>
<?php require_once("includes/Functions.php") ?>

<?php confirmLogin(); ?>
<!doctype>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comments</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="fontawesome/css/all.min.css" rel="stylesheet">
    <link href="fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="fontawesome/css/brands.css" rel="stylesheet">
    <link href="fontawesome/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="css/publicstyles.css">
    <link rel="stylesheet" href="css/adminstyles.css">
</head>
<body>

<div style="height: 10px; background: rebeccapurple;"></div>
<nav class="navbar navbar-expand-lg navbar-light bg-transparent">
    <a href="Blog.php" class="navbar-brand"> <img src="images/logos/academyLogo2.png" alt="Logo" width="150"
                                                  height="80"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
    <form action="Blog.php" class="form-inline my-2 my-lg-0" method="get">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="Search">
        <button class="btn btn-outline-success my-2 my-sm-0 rounded-pill" type="submit" name="SearchButton">Go</button>
    </form>
</nav>
<div style="height: 10px; background: rebeccapurple;"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <br>
            <h3 class="text-white">Ngo Alalibo's Blog</h3>
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
            <div><br><?php echo errorMessage();
					echo successMessage(); ?></div>
            <h1>Unapproved Comments</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Comment</th>
                        <th>Approve</th>
                        <th>Delete</th>
                        <th>Live Preview</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php
						$connection;
						$query = "select * from comments where status='OFF' order by datetime desc";
						$execute = $connection->query($query);
						$srno = 0;
						while ($dataRows = $execute->fetch())
						{
							$Id = htmlentities($dataRows["id"]);
							$name = htmlentities($dataRows["name"]);
							$email = htmlentities($dataRows["email"]);
							$dateTime = htmlentities($dataRows["datetime"]);
							$comment = htmlentities($dataRows["comment"]);
							$status = htmlentities($dataRows["status"]);
							$postid = htmlentities($dataRows["postid"]);
							$srno++;
							?>
                            <tr>
                                <td><?php echo $srno; ?></td>
                                <td class="blue-text"><?php
										
										if (strlen($name) > 20)
										{
											$name = substr($name, 0, 20) . "...";
											echo $name;
										}
										else
										{
											echo $name;
										} ?>
                                </td>
                                <td><?php
										if (strlen($email) > 15)
										{
											$email = substr($email, 0, 15) . "...";
											echo $email;
										}
										else
										{
											echo $email;
										} ?></td>
                                <td><?php echo $dateTime; ?></td>
                                <td><?php echo $comment; ?></td>
                                <td><a href="ApproveComments.php?id=<?php echo $Id ?>"><span
                                                class="btn btn-success btn-sm">Approve</span></a>
                                </td>
                                <td><a href="DeleteComment.php?id=<?php echo $Id; ?>"><span
                                                class="btn btn-danger btn-sm">Delete</span></a></td>
                                <td><a href="FullPost.php?id=<?php echo $postid; ?>" target="_blank"><span
                                                class=" btn btn-primary btn-sm">Live
                                    Preview</span></a></td>
                            </tr>
						<?php } ?>
                    </tbody>
                </table>
            </div>

            <h1>Approved Comments</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Comment</th>
                        <th>Approved By</th>
                        <th>UnApprove</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php
						$connection;
						$query = "select * from comments where status='ON' order by datetime desc";
						$execute = $connection->query($query);
						$srno = 0;
						while ($dataRows = $execute->fetch())
						{
							$Id = htmlentities($dataRows["id"]);
							$name = htmlentities($dataRows["name"]);
							$email = htmlentities($dataRows["email"]);
							$dateTime = htmlentities($dataRows["datetime"]);
							$comment = htmlentities($dataRows["comment"]);
							$status = htmlentities($dataRows["status"]);
							$postid = htmlentities($dataRows["postid"]);
							$approvedBy = htmlentities($dataRows["approvedby"]);
							$srno++;
							?>
                            <tr>
                                <td><?php echo $srno; ?></td>
                                <td class="blue-text"><?php
										
										if (strlen($name) > 20)
										{
											$name = substr($name, 0, 20) . "...";
											echo $name;
										}
										else
										{
											echo $name;
										} ?>
                                </td>
                                <td><?php
										if (strlen($email) > 15)
										{
											$email = substr($email, 0, 15) . "...";
											echo $email;
										}
										else
										{
											echo $email;
										} ?></td>
                                <td><?php echo $dateTime; ?></td>
                                <td><?php echo $comment; ?></td>
                                <td><?php echo $approvedBy; ?></td>
                                <td>Ngo Alalibo</td>
                                <td><a href="UnapproveComments.php?id=<?php echo $Id; ?>"><span
                                                class="btn btn-warning btn-sm">Unapprove</span></a></td>
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
</body>
</html>