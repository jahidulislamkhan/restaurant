<?php
include('database.php');
include('functions.php');
include('upload.php');

$db = db_connect();

if(request_is_post()){
	$title = $_POST['title'];
	$image = image_upload();
	$addons = array();
	$addons = $_POST['addon'];	

	$sql = "INSERT INTO `categories` (`title`, `image`) VALUES ('$title', '$image');";
	// var_dump($sql);
	// echo $sql;
	$check = mysqli_query($db,$sql);
	// var_dump($check);
	if($check){
		$category_id = mysqli_insert_id($db);
		// var_dump($item_id);
		foreach ($addons as $addon) {			
			$sql2 = "INSERT INTO category_addon (category_id, addon_id) VALUES ($category_id,$addon);";
			// echo "<br>Addon: ". $sql2. "<br>";
			$result = mysqli_query($db,$sql2);
		}
		// echo "Records added successfully";
		header("Location:category-list.php?sm=success");
	}else {
		echo "Sorry! There was a problem while uploading your image.";
	}
} else {
	echo "No Data Posted";
}
?>