<?php 
header("Content-Type: application/json; charset=UTF-8");
include('database.php');

$db = db_connect();
$all_items['category'] = array();


$category_sql = "SELECT * FROM categories";
$category_result = mysqli_query($db,$category_sql);
$category_index = 0;
while ( $category = mysqli_fetch_assoc($category_result)){
	$category_id = $category['id'];
	$all_items['category'][$category_index] = $category;
	$addon_sql = "SELECT addons.* FROM addons, category_addon where category_id=$category_id and addons.id = category_addon.addon_id";
			$addon_result = mysqli_query($db,$addon_sql);
			$addon_index = 0;
			while ( $addon = mysqli_fetch_assoc($addon_result)) {
				$addon_id = $addon['id'];
				$all_items['category'][$category_index]['addon'][$addon_index] = $addon;
				$addon_index++;
			}
	$all_items['category'][$category_index]['sub_categories'] = array();

	$sub_category_sql = "SELECT * FROM sub_categories where category_id=$category_id";
	$sub_category_result = mysqli_query($db,$sub_category_sql);
	$sub_category_index = 0;
	while ( $sub_category = mysqli_fetch_assoc($sub_category_result)) {
		$sub_category_id = $sub_category['id'];
		$all_items['category'][$category_index]['sub_categories'][$sub_category_index] = $sub_category;
		$all_items['category'][$category_index]['sub_categories'][$sub_category_index]['items'] = array();

		$items_sql = "SELECT * FROM items where sub_category_id=$sub_category_id";
		$items_result = mysqli_query($db,$items_sql);
		$item_index = 0;
		while ( $item = mysqli_fetch_assoc($items_result)) {
			$item_id = $item['id'];
			$all_items['category'][$category_index]['sub_categories'][$sub_category_index]['items'][$item_index] = $item;
			$all_items['category'][$category_index]['sub_categories'][$sub_category_index]['items'][$item_index]['recipe'] = array();

			$recipe_sql = "SELECT recipes.* FROM recipes, item_recipe where item_id=$item_id and recipes.id = item_recipe.recipe_id";
			$recipe_result = mysqli_query($db,$recipe_sql);
			$recipe_index = 0;
			while ( $recipe = mysqli_fetch_assoc($recipe_result)) {
				$recipe_id = $recipe['id'];
				$all_items['category'][$category_index]['sub_categories'][$sub_category_index]['items'][$item_index]['recipe'][$recipe_index] = $recipe;
				$recipe_index++;
			}
			$item_index++;
		}
		$sub_category_index++;
	}
	$category_index++;
}
echo json_encode($all_items);
?>