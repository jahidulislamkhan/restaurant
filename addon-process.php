<?php
include('database.php');
include('functions.php');
include('upload.php');

$db = db_connect();

if(request_is_post() ){

	$title = $_POST['title'];
	$price = $_POST['price'];
	$image = image_upload();
	
	$sql = "INSERT INTO `addons` (`title`,`price`,`image`) VALUES ('$title', '$price', '$image');";
	if(mysqli_query($db,$sql) ){
		 header("Location:addon-list.php?sm=success");
		// echo "Query success";
	}
	else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
	}

}
else{
	echo "ERROR: Could not able to execute " . mysqli_error($db);
}

?>