<?php
header("Content-Type: application/json; charset=UTF-8");
include('database.php');
include('functions.php');
$db = db_connect();
$data = array();
if (request_is_post()) {
	// echo file_get_contents('php://input');

	$json_received = json_decode(trim(file_get_contents("php://input")),true);

	$data['login'] = $json_received;
	$email =  urldecode($json_received['email']);
	// $data['email'] = $email;
	$password =  urldecode($json_received['password']);
	// $data['password'] = $password;
	// $email =  $_POST['email'];
	// $password =  $_POST['password'];
	$db_password = sha1($password);
	$sql = "SELECT id, email, mobile_no, reward_point FROM customers WHERE email = '$email' AND password = '$db_password' LIMIT 1";
	// $data['sql'] = $sql;
	$result = mysqli_query($db,$sql);
	if (mysqli_num_rows($result) > 0) {
		$customer = mysqli_fetch_assoc($result);
		$data['login']['response'] = true;
		$data['login']['id'] = $customer['id'];
		$data['login']['email'] = $customer['email'];
		$data['login']['mobile_no'] = $customer['mobile_no'];
		$data['login']['reward_point'] = $customer['reward_point'];
	} else {
	    $data['login']['response'] = false;
	    
	    // $data['inner_else'] = "inner_else";
	}
} else {
	$data['login']['response'] = false;
	
	// $data["response"] = false;
}
// echo json_encode($data);