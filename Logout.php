<?php require_once("includes/Sessions.php") ?>
<?php require_once("includes/Functions.php") ?>
<?php
	$_SESSION["currentUser"] = null;
	session_destroy();
	$_SESSION["successMessage"] = "Logout successful !";
	redirectTo("Login.php");
?>