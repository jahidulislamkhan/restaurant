<?php 
include('database.php');
include('functions.php');
include('upload.php');

$db = db_connect();

if(request_is_post() ){
	$title = $_POST['title'];
	$image = image_upload();
	$category_id = $_POST['category_id'];

	$sql = "INSERT INTO `sub_categories` (`title`, `image`, `category_id`) VALUES ('$title','$image','$category_id');";
	if(mysqli_query($db,$sql)){
		// echo "Records added successfully";
		header("Location:sub-category-list.php?sm=success");
	}
	else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
	}

}
else{
	echo "ERROR: Could not able to execute " . mysqli_error($db);
}

?>