<?php require_once("includes/DB.php") ?>
<?php require_once("includes/DateTime.php") ?>
<?php require_once("includes/Sessions.php") ?>
<?php require_once("includes/Functions.php") ?>

<?php confirmLogin(); ?>
<?php
	if (isset($_GET["Edit"]))
	{
		$editId = $_GET["Edit"];
	}
	if (isset($_POST["Submit"]))
	{
		$currentTime = datetime();
		$title = $_POST["title"];
		$category = $_POST["Category"];
		$author = $_SESSION["currentUser"];
		$image = $_FILES["imageselect"]["name"];
		$target = "Upload/" . basename($image);
		$postarea = $_POST["postarea"];
		
		echo "Category: $category<br>";
		if (empty($category))
		{
			$_SESSION["errorMessage"] = "Please enter category name!!!";
			//redirectTo("EditPost.php?Edit=$editId");
		}
		if (empty($title) || strlen($title) < 2)
		{
			$_SESSION["errorMessage"] = "Title cannot be empty of less than 2 characters";
			//redirectTo("EditPost.php?Edit=$editId");
		}
		if (empty($postarea) || strlen($postarea) < 2)
		{
			$_SESSION["errorMessage"] = "Please enter post";
		}
		else if (strlen($category) > 99)
		{
			$_SESSION["errorMessage"] = "Category name should not be greater than 99 characters";
			//redirectTo("EditPost.php?Edit=$editId");
		}
		else
		{
			global $connection;
			//			$query = "update admin_posts set datetime='$currentTime', title='$title', category='$category', image='$image', post='$postarea' where id='$editId'";
			$query = "update admin_posts set datetime=:datetime, title=:title, category=:category, image=:image, post=:post where id=:id";
			
			
			$stmt = $connection->prepare($query);
			$stmt->bindValue(':datetime', datetime());
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':category', $category);
			$stmt->bindValue(':image', $image);
			$stmt->bindValue(':post', $postarea);
			$stmt->bindValue(':post', $postarea);
			$stmt->bindValue(':id', $editId);
			$execute = $stmt->execute();
			
			move_uploaded_file($_FILES["imageselect"]["tmp_name"], $target);
			if ($execute)
			{
				$_SESSION["successMessage"] = "Post updated successfully";
				redirectTo("Dashboard.php");
			}
			else
			{
				$_SESSION["errorMessage"] = "Something went wrong. Try Again !";
			}
			
		}
	}

?><br>
<!doctype>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
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
<div style="height: 10px; background: rebeccapurple;"></div> <!--Header Start-->
<nav class="navbar navbar-expand-lg navbar-default bg-light">
    <a href="index.php" class="navbar-brand"> <img src="images/logos/academyLogo2.png" alt="Logo" width="150"
                                                   height="80"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active btn btn-dark btn-sm"><a class="nav-link" href="index.php">Blog Home<span
                            class="sr-only">(current)</span></a></li>
            <!--<li class="nav-item"><a class="nav-link" href="#">Home</a></li>-->
            <!--<li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Feature</a></li>-->
        </ul>
    </div>
    <!--<form class="form-inline navbar-form navbar-right">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>-->
</nav>
<div style="height: 10px; background: rebeccapurple;"></div> <!--Header End-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <br>
            <h3 class="text-white">Ngo Alalibo's Blog</h3>
            <br>
            <ul id="Side_Menu" class="nav nav-pills d-block">
                <li class="nav-item"><span class="fas fa-th text-warning mx-2"></span><a
                            href="Dashboard.php">Dashboard</a></li>
                <li class="nav-item active"><span class="fas fa-plus-square text-warning mx-2"></span><a href="AddNewPost.php">Manage
                        Posts</a>
                </li>
                <li class="nav-item"><span class="fas fa-user text-warning mx-2"></span><a
                            href="Categories.php">Categories</a></li>
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
                <li class="nav-item"><span class="fab fa-github-square text-warning mx-2"></span><a href="index.php" target="_blank">Live
                        Blog</a>
                </li>
                <li class="nav-item"><span class="fas fa-sign-out-alt text-warning mx-2"></span><a href="Logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-10"> <!--Menu End-->
            <h1>Edit Post</h1>
            <div><?php echo errorMessage() ?></div>
            <div><?php echo successMessage() ?></div>
            <div>
				<?php
					global $connection;
					$editId = $_GET["Edit"];
					
					$query = "select * from admin_posts where id='$editId'";
					$execute = $connection->query($query);
					if ($dataRows = $execute->fetch())
					{
						$title = htmlentities($dataRows["title"]);
						$category = htmlentities($dataRows["category"]);
						$image = $dataRows["image"];
						$post = htmlentities($dataRows["post"]);
					}
				?>
                <form action="EditPost.php?Edit=<?php echo $editId; ?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label class="purple-text"
                                   for="title">Title:</label>
                            <input class="form-control" type="text" name="title" id="title" value="<?php echo $title; ?>" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <span class="card-text">Existing Category: </span><?php echo $category; ?><br>
                            <label class="purple-text"
                                   for="category">Category:</label>
                            <select class="form-control" name="Category" id="Category">
								<?php
									global $connection;
									$query = "select * from category order by datetime desc";
									$execute = $connection->query($query);
									while ($dataRows = $execute->fetch())
									{
										$Id = $dataRows["id"];
										$name = htmlentities($dataRows["name"]);
										?>
                                        <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
									<?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <span class="card-text">Existing Image: </span><img src="Upload/<?php echo $image; ?>"
                                                                                width="50px" height="60px" alt=""><br>
                            <label class="purple-text"
                                   for="imageselect">Image Select:</label>
                            <input class="form-control" type="file" name="imageselect" id="imageselect"
                                   placeholder="Image Select">
                        </div>
                        <div class="form-group">
                            <label class="purple-text"
                                   for="postarea">Post Area:</label>
                            <textarea class="form-control-file" name="postarea" id="postarea" cols="30"
                                      rows="4"><?php echo $post; ?></textarea>
                        </div>
                        <input class="btn btn-primary btn-block" type="Submit" name="Submit" value="Update Post">
                    </fieldset>
                    <br>
                </form>
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