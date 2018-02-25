<?php include('session.php');?>
<?php
    if (!isLoggedIn()) {
        header("Location: login.php");
    } else echo "<br>Email: ".$_SESSION['email']."<br>";
?>
<?php include('header.php');?>
<?php include('database.php');?>
<?php 
$db = db_connect();
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    //var_dump($id);

    $sql = "SELECT * FROM customers WHERE id = $id LIMIT 1";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $mobile_no = $row['mobile_no'];
    $device_name = $row['device_name'];
    $imei_no = $row['imei_no'];
    $reward_point = $row['reward_point'];
}else {
    echo "Customer id is invalid";
}

?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Customer Update
            </div>            
        </div>
        <form action="customer-edit-process.php" method="POST">
            <div class="form-group col-md-4">                
                <input type="hidden" name="id" class="form-control" value="<?php echo $id;?>" required >
            </div>
            <div class="form-group col-md-4">
                <label for="formGroupExampleInput">Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email;?>" required >
            </div>
            <div class="form-group col-md-4">
                <label for="formGroupExampleInput">Mobile No.</label>
                <input type="text" name="mobile_no" class="form-control" value="<?php echo $mobile_no;?>" required >
            </div>
            <div class="form-group col-md-4">
                <label for="formGroupExampleInput">Device Name</label>
                <input type="text" name="device_name" class="form-control" value="<?php echo $device_name;?>" required >
            </div>
            <div class="form-group col-md-4">
                <label for="formGroupExampleInput">IMEI No</label>
                <input type="text" name="imei_no" class="form-control" value="<?php echo $imei_no;?>" required >
            </div>
            <div class="form-group col-md-4">
                <label for="formGroupExampleInput">Reward Point</label>
                <input type="text" name="reward_point" class="form-control" value="<?php echo $reward_point;?>" required >
            </div>            
            <div class="form-group col-md-6">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>

    </div>
<?php include('footer.php');?>