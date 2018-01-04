<?php

include 'include/db_connect.php';

if( isset($_POST["username"]) && isset($_POST["password"]) )
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	$sql="select id from teacher_master where username='".$username."' AND password='".$password."'";
	echo $sql;
	$result=$conn->query($sql);
	if($result->num_rows==1)
	{
		//Login Successful
		session_start();
		$row = $result->fetch_assoc();
		$id = $row['id'];
		$_SESSION["teacher_id"]=$id;
		header('Location:teacher_home.php');

	}
	else
	{
		//Login Failed
		session_start();
		$_SESSION["faliure_message"]="Sorry wrong username or password";
		header('Location:student_login.php');
	}
}
else
{
	echo "Invalid access to the script";
}


?>


<html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>