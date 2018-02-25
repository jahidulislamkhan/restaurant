<?php
header("Content-Type: application/json; charset=UTF-8");
include('database.php');
include('functions.php');

$db = db_connect();
$data = array();
if(request_is_post()){
	$new_order = json_decode(trim(file_get_contents("php://input")),true);
	$customer_details = $new_order['new_order']['customer_info'];
	$order_details = $new_order['new_order']['order_list'];
	$order_id = time();
	$customer_id = $customer_details['customer_id'];
	$reward_point = $customer_details['reward_point'];

	$flag = true;
	$message = array();

	// $customer_data_sql = "SELECT * FROM customers WHERE id=$customer_id";
	// $customer_result = mysqli_query($db, $customer_data_sql);
	// $customer_data = mysqli_fetch_assoc($customer_result);
	// $original_reward_point = $customer_data['reward_point'];

	foreach ($order_details as $order) {
		$item_id = $order['item_id'];
		$quantity = $order['quantity'];
		$unit_price = $order['unit_price'];
		$recipes = $order['recipes'];
		$addons = $order['addons'];
		$addons_string = implode(',', $addons);
		$addon_price_sql = "SELECT SUM(price) as addon_total_price FROM addons WHERE id IN ($addons_string)";
		$addon_price_query = mysqli_query($db, $addon_price_sql);
		$addon_total_price = mysqli_fetch_assoc($addon_price_query);
		$addon_price = $addon_total_price['addon_total_price'];
		// $data['addon_price'][] = $addon_price;
		$item_price = ($quantity * $unit_price);
		$total_price = $item_price + $addon_price;
		$order_sql = "INSERT INTO orders(id, customer_id, item_id, quantity, unit_price, item_price, addon_price, total_price) VALUES($order_id, $customer_id, $item_id, $quantity, $unit_price, $item_price, $addon_price, $total_price)";
		// $data['order_sql'] = $order_sql;
		mysqli_query($db, $order_sql);
		if (mysqli_affected_rows($db) > 0 && $flag === true) {
			foreach ($addons as $addon) {
				$addon_sql = "INSERT INTO order_addon(order_id, addon_id, item_id) VALUES($order_id, $addon, $item_id)";
				// $data['addon_query'][] = $addon_sql;
				mysqli_query($db, $addon_sql);
				if (mysqli_affected_rows($db) < 1 || $flag === false) {
					$addon_del_sql = "DELETE FROM order_addon WHERE order_id=$order_id";
					mysqli_query($db, $addon_del_sql);
					$order_del_sql = "DELETE FROM orders WHERE id=$order_id";
					mysqli_query($db, $order_del_sql);
					$flag = false;
					// $message['addon'][] = "addon failed";
				}
			}
			foreach ($recipes as $recipe) {
				$recipe_sql = "INSERT INTO order_recipe(order_id, recipe_id, item_id) VALUES($order_id, $recipe, $item_id)";
				// $data['recipe_query'][] = $recipe_sql;
				mysqli_query($db, $recipe_sql);
				if (mysqli_affected_rows($db) < 1 || $flag === false) {
					$recipe_del_sql = "DELETE FROM order_recipe WHERE order_id=$order_id";
					mysqli_query($db, $recipe_del_sql);
					$addon_del_sql = "DELETE FROM order_addon WHERE order_id=$order_id";
					mysqli_query($db, $addon_del_sql);
					$order_del_sql = "DELETE FROM orders WHERE id=$order_id";
					mysqli_query($db, $order_del_sql);
					$flag = false;
					// $message['recipe']['recipe_del_sql'] = "recipe failed";
				}
			}
		} else {
			$order_del_sql = "DELETE FROM orders WHERE id=$order_id";
			mysqli_query($db, $order_del_sql);
			$flag = false;
			// $message['order'][] = "order failed";
		}
	}
	if ($flag === true) {
		$reward_point_sql = "INSERT INTO order_reward_point(order_id, reward_point) VALUES($order_id, $reward_point)";
		// $data['rwp'] = $reward_point_sql;
		mysqli_query($db, $reward_point_sql);
		if (mysqli_affected_rows($db) > 0) {
			$data['response']  = "Order Placed Successfully";
		} else {
			$recipe_del_sql = "DELETE FROM order_recipe WHERE order_id=$order_id";
			mysqli_query($db, $recipe_del_sql);
			$addon_del_sql = "DELETE FROM order_addon WHERE order_id=$order_id";
			mysqli_query($db, $addon_del_sql);
			$order_del_sql = "DELETE FROM orders WHERE id=$order_id";
			mysqli_query($db, $order_del_sql);
			// $message['reward_point'] = "reward_point failed";
			$data['failed']  = "Order Placement failed";
			// $data['message'] = $message;
		}
	} else {
		$data['failed']  = "Order Placement failed";
		// $data['message'] = $message;
	}
} else {
	$data['response'] = 'failed';
}
echo json_encode($data);
?>