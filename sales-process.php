<?php
include('database.php');
include('functions.php');

$db = db_connect();
$data = array();
if(request_is_post() && isset($_POST['confirm'])){
	$order_id = $_POST['order_id'];
	$customer_id = 0;
	//var_dump($order_id);
	$order_sql = "SELECT * FROM orders WHERE id=$order_id";
	$result = mysqli_query($db, $order_sql);
	while ($order = mysqli_fetch_assoc($result)) {
		$order_id = $order['id'];
		$customer_id  = $order['customer_id'];
		$item_id = $order['item_id'];
		$quantity = $order['quantity'];
		$unit_price = $order['unit_price'];
		$item_price = $order['item_price'];
		$sales_sql = "INSERT INTO sales(id, customer_id, item_id, quantity, unit_price, item_price) VALUES($order_id, $customer_id, $item_id, $quantity, $unit_price, $item_price)";
		mysqli_query($db, $sales_sql);

		$addon_sql = "SELECT * FROM order_addon WHERE order_id=$order_id AND item_id=$item_id";
		//echo "$addon_sql";
		$addon_result = mysqli_query($db, $addon_sql);
		while ($addon = mysqli_fetch_assoc($addon_result)) {
			$addon_id = $addon['addon_id'];
			$addon_insert_sql = "INSERT INTO sales_addon(order_id, item_id, addon_id) VALUES($order_id, $item_id, $addon_id)";
			mysqli_query($db, $addon_insert_sql);
		}

		$recipe_sql = "SELECT * FROM order_recipe WHERE order_id=$order_id AND item_id=$item_id";
		$recipe_result = mysqli_query($db, $recipe_sql);
		while ($recipe = mysqli_fetch_assoc($recipe_result)) {
			$recipe_id = $recipe['recipe_id'];
			$recipe_insert_sql = "INSERT INTO sales_recipe(order_id, item_id, recipe_id) VALUES($order_id, $item_id, $recipe_id)";
			mysqli_query($db, $recipe_insert_sql);
		}
	}
	if ($customer_id != 0) {
		$reward_point_count_sql = "SELECT SUM(reward_point) as total_reward_point FROM `order_reward_point` WHERE order_id=$order_id";
		$reward_point_count_result = mysqli_query($db, $reward_point_count_sql);
		$reward_point_count = mysqli_fetch_assoc($reward_point_count_result);
		$total_reward_point = $reward_point_count['total_reward_point'];
		$update_customer_reward_point_sql = "UPDATE customers SET reward_point=reward_point+$total_reward_point WHERE customer_id=$customer_id";
		mysqli_query($db, $update_customer_reward_point_sql);
	} else {
		echo "Failed to update customer reward point";
	}
	header("Location:order-list.php");
} else {
	echo "failed.";
}
?>