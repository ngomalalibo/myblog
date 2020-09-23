<?php require_once("includes/DB.php") ?>
<?php require_once("includes/Sessions.php") ?>
<?php require_once("includes/DateTime.php") ?>
<?php
	//	echo "Functions.php called<br>";
	function redirectTo($newLocation)
	{
		header("Location:" . $newLocation);
		exit;
	}
	
	function getApprovedComments($postid)
	{
		global $connection;
		$query = "select count(*) from comments where postid='$postid' and status='ON'";
		$execute = $connection->query($query);
		$rowsReturned = $execute->fetch();
		return array_shift($rowsReturned);
	}
	
	function getUnapprovedComments($postid)
	{
		global $connection;
		$query = "select count(*) from comments where postid='$postid' and status='OFF'";
		$execute = $connection->query($query);
		$rowsReturned = $execute->fetch();
		return array_shift($rowsReturned);
	}
	
	function getAllUnapprovedComments()
	{
		global $connection;
		$query = "select count(*) from comments where status='OFF'";
		$execute = $connection->query($query);
		$rowsReturned = $execute->fetch();
		return array_shift($rowsReturned);
	}
	
	function getPostComments($postid)
	{
		global $connection;
		$query = "select count(*) from comments where postid='$postid'";
		$execute = $connection->query($query);
		$rowsReturned = $execute->fetch();
		return array_shift($rowsReturned);
	}
	
	function login($username, $password)
	{
		global $connection;
		$query = "select * from admins where username='$username' and password='$password' LIMIT 1";
		$execute = $connection->query($query);
		
		while ($dataRows = $execute->fetch())
		{
			return $dataRows;
		}
		
		return null;
		
	}
	
	function getCategories()
	{
		global $connection;
		$query = "select * from category order by datetime desc";
		$execute = $connection->query($query);
		while ($dataRows = $execute->fetch())
		{
			return $dataRows;
		}
		
	}
	
	function loginStatus()
	{
		if (isset($_SESSION["currentUser"]))
		{
			return true;
		}
		return false;
	}
	
	function confirmLogin()
	{
		if (!loginStatus())
		{
			$_SESSION["errorMessage"] = "Login required !";
			redirectTo("Login.php");
		}
	}

?><br>