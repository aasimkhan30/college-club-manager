<?php
	$name = $_POST["name"];	
	$short = $_POST["short"];	
	$date = $_POST["date"];	
	$site = $_POST["site"];	
	$disc = $_POST["disc"];		
	$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["img"][$name.$short]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["img"][$name.$short]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
?>