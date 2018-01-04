<?php

include 'include/db_connect.php';
$sid=$_POST["sid"];
$cid=$_POST["cid"];
$sql="insert into clubregister (student_id,club_id) values (".$sid.",".$cid.")";
$result=$conn->query($sql);
echo json_encode($sql);
 ?>
