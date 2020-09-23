<?php require_once("includes/DB.php") ?>
<?php require_once("includes/DateTime.php") ?>
<?php require_once("includes/Sessions.php") ?>
<?php require_once("includes/Functions.php") ?>

<!doctype>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Page</title>
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
    <a href="index.php" class="navbar-brand"> <img src="images/logos/academyLogo2.png" alt="Logo" width="150"
                                                   height="80"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active"><a class="nav-link" href="index.php">Blog Home<span
                            class="sr-only">(current)</span></a></li>
            <li class="nav-item"><a class="nav-link" href="Dashboard.php">Dashboard</a></li>
            <!--<li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Feature</a></li>-->
        </ul>
    </div>
    <form action="index.php" class="form-inline my-2 my-lg-0" method="get">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="Search">
        <button class="btn btn-outline-success my-2 my-sm-0 rounded-pill small" type="submit" name="SearchButton">Go</button>
    </form>
</nav>
<div style="height: 10px; background: rebeccapurple;"></div>
<br>
<br>
<br>
<div class="container">
    <div class="blog-header">
        <h1 class="text-primary">Ngo Alalibo's Blog</h1>
        <h6 class="heading">The truth is the most valuable thing... In every field of endeavour.</h6>
    </div>
    <div class="row">
        <div class="col-sm-8">
			<?php
				global $connection;
				if (isset($_GET["SearchButton"])) /*search button*/
				{
					$search = $_GET["Search"];
					$query = "select * from admin_posts where datetime like '%$search%' or title like '%$search%' or category like '%$search%' or post like '%$search%'  order by datetime desc";
				}
				else if (isset($_GET["Category"])) /*categoty posts*/
				{
					$category = $_GET["Category"];
					$query = "select * from admin_posts where category='$category' order by datetime desc";
				}
				else if (isset($_GET["Page"]))
				{
					$page = $_GET["Page"];
					if ($page <= 0)
					{
						$showFrom = 0;
					}
					else
					{
						$showFrom = ($page * 3) - 3;
					}
					
					$query = "select * from admin_posts order by datetime desc LIMIT $showFrom,3";
				}
				else /*default*/
				{
					$query = "select * from admin_posts order by datetime desc LIMIT 0,3";
				}
				$execute = $connection->query($query);
				while ($dataRows = $execute->fetch())
				{
					$Id = $dataRows["id"];
					$dateTime = $dataRows["datetime"];
					$title = htmlentities($dataRows["title"]);
					$category = htmlentities($dataRows["category"]);
					$author = htmlentities($dataRows["author"]);
					$image = $dataRows["image"];
					$post = htmlentities($dataRows["post"]);
					?>
                    <div class="card card thumbnail gray-background m-5 p-5 overflow-hidden">
                        <img class="img-responsive align-self-center" src="Upload/<?php echo $image; ?>" alt=""
                             width="600" height="500">
                        <div class="caption">
                            <h3 class="blue-text hoverable align-items-stretch"
                                id="heading"><?php echo htmlentities($title); ?></h3>
                            <p class="text-black-50 font-small">Category: <?php echo htmlentities($category); ?>
                                Published
                                on: <?php echo htmlentities($dateTime) ?>
								
								<?php
									$noOfComments = getPostComments($Id);
									if ($noOfComments > 0)
									{
										?>
                                        <span class="badge-pill badge-light float-right small"><?php echo "Comments:  " . $noOfComments; ?> </span>
									<?php } ?>


                            </p>
                            <p class="text-justify"><?php
									
									if (strlen($post) > 150)
									{
										$post = substr($post, 0, 150) . "...";
										echo $post;
									}
									else
									{
										echo $post;
									} ?></p>
                        </div>
                        <a href="FullPost.php?id=<?php echo $Id; ?>"><span class="btn btn-info float-right">Read more &rsaquo;&rsaquo;&rsaquo;</span></a>
                    </div>
				<?php } ?>
			<?php
				if (isset($_GET["Page"]))
				{
			?>
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-lg pagination-circle">
					<?php
						if ($page > 1)
						{
							?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?Page=<?php echo $page - 1; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
						<?php } ?>
					<?php
						global $connection;
						
						$query = "select count(*) from admin_posts";
						$stmt = $connection->query($query);
						$totalRows = $stmt->fetch();
						$totalPosts = array_shift($totalRows);
						$noOfPages = ceil($totalPosts / 3);
						
						
						for ($i = 1; $i <= $noOfPages; $i++)
						{
							if ($i == $page)
							{
								?>

                                <li class="page-item active"><a class="page-link" href="index.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
							<?php }
							else
							{
								?>
                                <li class="page-item"><a class="page-link" href="index.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
							<?php } ?>
						<?php } ?>
					<?php
						if ($page + 1 <= $noOfPages)
						{
							?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?Page=<?php echo $page + 1; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
						<?php } ?>
                </ul>
				<?php } ?>
            </nav>

        </div>
        <div class="offset-1 col-sm-3"><!--side area-->
            <h1>About Me</h1>
            <figure class="figure">
                <img src="images/ngo.jpg" class="img-responsive figure-img img-fluid rounded" alt="me">
                <figcaption class="figure-caption text-justify">

                    <p><span class="50">Ngo Alalibo is a life-long learning, software engineer and information technology enthusiast.
                            I believe in the power and purpose of information within an organization and nation.
                            I am passionate about innovation, satisfying customers, learning and mentoring.</span>
                    </p>

                </figcaption>
            </figure>
            <div class="card border-primary">
                <div class="card-header bg-primary">
                    <h2 class="card-title">Categories</h2>
                </div>
                <div class="card-body text-info">
					<?php
						global $connection;
						$query = "select * from category order by datetime desc";
						$execute = $connection->query($query);
						while ($dataRows = $execute->fetch())
						{
							$id = $dataRows["id"];
							$category = htmlentities($dataRows["name"]);
							?>
                            <span><a href="index.php?Category=<?php echo $category; ?>"><?php echo $category . "<br>"; ?></a></span>
						<?php } ?>
                </div>
                <div class="card-footer"></div>

            </div>
            <br>

            <div class="card border-primary">
                <div class="card-header bg-primary">
                    <h2 class="card-title">Recent Posts</h2>
                </div>
                <div class="card-body text-info">
					<?php
						$connection;
						$query = "select * from admin_posts order by datetime desc limit 0,5";
						$execute = $connection->query($query);
						while ($dataRows = $execute->fetch())
						{
							$id = $dataRows["id"];
							$title = htmlentities($dataRows["title"]);
							$dateTime = $dataRows["datetime"];
							$post = htmlentities($dataRows["post"]);
							$image = $dataRows["image"];
							?>
                            <div>
                                <figure class="figure">
                                    <img class="img-fluid img-thumbnail figure-img m-2 float-left" src="Upload/<?php echo $image; ?>" alt="post" width="70px" height="80px">
                                    <figcaption class="figure-caption float-right">
                                        <p class="my-1 py-0"><span><a href="Fullpost.php?id=<?php echo $id; ?>"><?php echo $title; ?></a></span></p>
                                        <p class="text-dark large-2 my-1 py-0"><?php
												if (strlen($post) > 15)
												{
													echo substr($post, 0, 15);
												}
												else
												{
													echo $post;
												}
											?></p>
                                        <p class="small my-1 py-0">
											<?php if (strlen($dateTime) > 11)
											{
												echo substr($dateTime, 0, 11);
											}
											else
											{
												echo $dateTime;
											} ?>
                                        </p>
                                    </figcaption>
                                </figure>
                            </div>
						
						<?php } ?>
                </div>
                <div class="card-footer"></div>

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