<?php
ob_start();
include('database.php');
session_start(); 
$db = db_connect();

$email = $_POST['email'];
$password = $_POST['password'];
$db_password = sha1($password);
if ($db) {
    $sql = "SELECT * FROM user where email='$email' and password='$db_password' limit 1";
    $result = mysqli_query($db,$sql);   
}

if (mysqli_num_rows($result) > 0) {
	$user = mysqli_fetch_assoc($result);
	$_SESSION['email'] = $user['email'];
	header("Location: index.php");
} else {
	echo "Sorry! The credentials you provided was incorrect. Try again !!!".mysqli_error($db);
	session_destroy();
}
ob_end();