<?php
include "include/db_connect.php";
	$name = $_POST["name"];	
	$short = $_POST["short"];	
	$date = $_POST["date"];	
	$site = $_POST["site"];	
	$disc = $_POST["disc"];		
	$id = $_POST["id"];	
	echo $date;
	$target_dir = "img/";
$date=date('Y-m-d',strtotime($date));

	$sql="insert into activity_master (name,description,site,image,date,shortdisc,club_id) values ('".$name."','".$disc."','".$site."','".$_FILES['image']['name']."','".$date."','".$short."',".$id.")";
$result=$conn->query($sql);


 if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"img/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
?>