<?php 
include('session.php');
if (!isLoggedIn()) {
    header("Location: login.php");
    }
else {
    echo "<br>Email: ".$_SESSION['email']."<br>";
}
include('header.php');
include('functions.php');
include('database.php');
$db = db_connect();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM addons WHERE id = $id LIMIT 1";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
    $image = $row['image'];
    $price = $row['price'];
}
else {
    echo "No id Found";
}

?>

<!-- input field and items load here -->

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card-header" style="margin-bottom: 10px">
            <i class="fa fa-table"></i> <strong> Addon Input Page</strong>
        </div>
        <form action="addon-process.php" method="POST" enctype="multipart/form-data">
            <div class="form-group col-md-4">
                <label for="formGroupExampleInput">Enter New Addon</label>
                <input type="text" name="title" class="form-control" value="<?php echo $title;?>" required >
            </div>
            <div class="form-group col-md-4">
                <label for="formGroupExampleInput">Enter Addon Price</label>
                <input type="text" name="price" class="form-control" value="<?php echo $price;?>" required >
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlFile1">Upload Addon Image</label>
                <input type="file" name="image" class="form-control-file" value="<?php echo $image;?>" >
            </div>
            <div class="form-group col-md-6">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

    <!-- Example DataTables Card-->
    
<?php include('footer.php');?>