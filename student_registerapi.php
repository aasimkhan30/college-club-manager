<?php

include 'include/db_connect.php';
$sid=$_POST["sid"];
$aid=$_POST["aid"];
$sql="insert into register_master (student_id,activity_id) values (".$sid.",".$aid.")";
$result=$conn->query($sql);
echo json_encode($sql);
 ?>
