<?php
	session_start();
	if(isset($_SESSION["teacher_id"]))
	{
		unset($_SESSION["teacher_id"]);
		header('Location:student_login.php');
	}
?>

