<?php
$servername="localhost";
$username="root";
$password="";
$db="eca";
$conn=new mysqli($servername,$username,$password,$db);
if($conn->connect_error)
	die ("Connection Failed".$conn->connect_error);
?>