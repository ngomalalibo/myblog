<?php require_once("includes/DB.php") ?>
<?php require_once("includes/DateTime.php") ?>
<?php require_once("includes/Sessions.php") ?>
<?php require_once("includes/Functions.php") ?>

<?php
	$connection;
	if (isset($_GET["id"]))
	{
		$commentId = $_GET["id"];
		$query = "update comments set status='OFF' where id='$commentId'";
		$execute = $connection->query($query);
		if ($execute)
		{
			$_SESSION["successMessage"] = "Comment unapproved successfully";
			redirectTo("Comments.php");
		}
		else
		{
			$_SESSION["errorMessage"] = "Something went wrong. Try again later  !";
			redirectTo("Comments.php");
		}
	}
?>
