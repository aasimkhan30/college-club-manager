<?php

include 'include/db_connect.php';
$id=$_POST["id"];
$sql="select * from activity_master where id=".$id;
$result=$conn->query($sql);
if($row = $result->fetch_assoc())
	$response=json_encode($row);

echo $response;
 ?>
