<?php

include 'include/db_connect.php';
$sid=$_GET["id"];
$aid=$_GET["club"];
$sql="update register_master set payment=1 where student_id=".$sid." and activity_id=".$aid;
$result=$conn->query($sql);
echo json_encode($sql);
 ?>




