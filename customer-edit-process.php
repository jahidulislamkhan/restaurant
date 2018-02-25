<?php include('session.php');?>
<?php
    if (!isLoggedIn()) {
        header("Location: login.php");
    } else echo "<br>Email: ".$_SESSION['email']."<br>";
?>
<?php
	include('database.php');
	include('functions.php');
?>
<?php 
$db = db_connect();
echo "conn";
if (request_is_post()) {
	$id = $_POST['id'];
    $email = $_POST['email'];
    $mobile_no = $_POST['mobile_no'];
    $device_name = $_POST['device_name'];
    $imei_no = $_POST['imei_no'];
    $reward_point = $_POST['reward_point'];
    $update_sql = "UPDATE `customers` SET email = '$email', mobile_no = $mobile_no, device_name = '$device_name', imei_no= '$imei_no', reward_point = $reward_point WHERE id = $id";
    mysqli_query($db,$update_sql);
    header("Location:customer-list.php");
} else {
	echo "failed";
}
?>