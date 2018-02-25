<?php include('session.php');?>
<?php
    if (!isLoggedIn()) {
        header("Location: login.php");
    } else echo "<br>Email: ".$_SESSION['email']."<br>";
?>
<?php include('database.php');?>
<?php 
$db = db_connect();
if ($db) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM addons WHERE id = $id LIMIT 1";
        mysqli_query($db,$sql);
        header("Location:addon-list.php");
    }
}
?>