<?php
header("Content-Type: application/json; charset=UTF-8");
include('database.php');
include('functions.php');
$db = db_connect();
$data = array();
if (request_is_post()) {
	$json_received = json_decode(trim(file_get_contents("php://input")),true);
	$email =  urldecode($json_received['email']);
	$password =  urldecode($json_received['password']);
	$db_password = sha1($password);
	$mobile_no =  $json_received['mobile_no'];
	$device_name =  $json_received['device_name'];
	$imei_no =  $json_received['imei_no'];
	$sql = "INSERT INTO customers (email, password, mobile_no, device_name, imei_no) VALUES ('$email', '$db_password', '$mobile_no', '$device_name', '$imei_no')";
	// $data['sql'] = $sql;
	$result = mysqli_query($db,$sql);
	if (mysqli_affected_rows($db) > 0){		
		$data['registration']['response'] = true;
		$data['registration']['email'] = $email;
		$data['registration']['mobile_no'] = $mobile_no;
		// $data['reward_point'] = $reward_point;
	}
	else{
	    // echo "Problem found in query".mysqli_error($db);
	    $data['registration']['response'] = false;
	    $data['registration']['email'] = "email already registered";
		// $data['registration']['email'] = 'email already registered';
	}
	}
else {
	$data['registration']['response'] = false;
	// $data['registration']['email'] = '';
	// $data['registration']['mobile_no'] = '';
	// $data['registration']['reward_point'] = '';
	// echo "Data not posted";
}
echo json_encode($data);