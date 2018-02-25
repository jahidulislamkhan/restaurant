<?php
include('database.php');
include('functions.php');
include('upload.php');

$db = db_connect();

if($db){
	$title = $_POST['title'];
	$image = image_upload();
	$sql = "INSERT INTO `recipes` (`title`, `image`) VALUES ('$title', '$image');";

	if(mysqli_query($db,$sql)){
		// echo "Records added successfully";
		header("Location:recipe-list.php?sm=success");
	}
	else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
	}

}
else{
	echo "ERROR: Could not able to execute " . mysqli_error($db);
}
