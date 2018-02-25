<?php
include('database.php');
include('functions.php');

$db = db_connect();
//$data = array();
if(request_is_post() && isset($_POST['cancel'])){
	$order_id = $_POST['order_id'];
	$customer_id = 0;
	$order_sql = "SELECT * FROM orders WHERE id = $order_id";
	$result = mysqli_query($db, $order_sql);
	// if ($db) {
		$update_status = "UPDATE orders SET status = 3 WHERE id = $order_id";
		mysqli_query($db,$update_status);
		// $update_customer_reward_point_sql = "DELETE id FROM order_reward_point  WHERE order_id = $order_id";
		// mysqli_query($db, $update_customer_reward_point_sql);
		// }
		// else {
		// 	echo "Status did not change!!";
		// }

	// if ($customer_id != 0) {
		// $reward_point_count_sql = "SELECT SUM(reward_point) as total_reward_point FROM order_reward_point WHERE order_id=$order_id";
		// $reward_point_count_result = mysqli_query($db, $reward_point_count_sql);
		// $reward_point_count = mysqli_fetch_assoc($reward_point_count_result);
		// $total_reward_point = $reward_point_count['total_reward_point'];
		
	// } else {
	// 	echo "Failed to update customer reward point";
	// }
	 header("Location:order-list.php");
} else {
	echo "failed.";
}
?>