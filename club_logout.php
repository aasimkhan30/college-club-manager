<?php
	session_start();
	if(isset($_SESSION["club_id"]))
	{
		unset($_SESSION["club_id"]);
		header('Location:student_login.php');
	}
?>

