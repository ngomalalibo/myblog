<?php require_once("includes/DB.php") ?>
<?php require_once("includes/DateTime.php") ?>
<?php require_once("includes/Sessions.php") ?>
<?php require_once("includes/Functions.php") ?>

<?php
	$connection;
	if (isset($_GET["id"]))
	{
		$id = $_GET["id"];
		$query = "delete from admins where id='$id'";
		$execute = $connection->query($query);
		if ($execute)
		{
			$_SESSION["successMessage"] = "Admin deleted successfully";
			redirectTo("Admins.php");
		}
		else
		{
			$_SESSION["errorMessage"] = "Something went wrong. Try again later  !";
			redirectTo("Admins.php");
		}
	}
?>
