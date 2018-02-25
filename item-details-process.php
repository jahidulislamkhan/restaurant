<?php
include('database.php');
include('upload.php');
include('functions.php');

$db = db_connect();

if(request_is_post() ){	
	$title = $_POST['title'];
	$image = image_upload();
	$price = $_POST['price'];
	$details = $_POST['details'];
	$category_id = $_POST['category_id'];

	if ($_POST['sub_category_id'] == "0") {
    	// $_POST['sub_category_id'] = NULL;
    	$sub_category_id = "NULL"; 
	}else {
		$sub_category_id = $_POST['sub_category_id'];		
	}
	// $sub_category_id = $_POST['sub_category_id'];
    var_dump($sub_category_id);
    echo "<br>";
	// $sub_category_id = $_POST['sub_category_id'];
	// var_dump($sub_category_id);
	// $recipe_id = $_POST['id'];
	$recipes = array();
	$recipes = $_POST['recipe'];	

	$sql = "INSERT INTO items (title,image,price,details,category_id,sub_category_id) VALUES ('$title','$image',$price,'$details',$category_id,$sub_category_id)";
	// var_dump($sql);
	// echo $sql;
	$check = mysqli_query($db,$sql);
	// var_dump($check);
	if($check){
		$item_id = mysqli_insert_id($db);
		// var_dump($item_id);

		foreach ($recipes as $recipe) {			
			$sql2 = "INSERT INTO item_recipe (item_id,recipe_id) VALUES ($item_id,$recipe);";
			// echo "<br>Item Recipe: ". $sql2. "<br>";
			$result = mysqli_query($db,$sql2);
		}
		// echo "Records added successfully";
		header("Location:item-details-list.php?sm=success");
	}
	else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
	}

}
else{
	echo "ERROR: Could not able to execute " . mysqli_error($db);
}


;?>