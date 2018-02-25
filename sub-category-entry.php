<?php include('session.php');?>
<?php
    if (!isLoggedIn()) {
        header("Location: login.php");
    } else echo "<br>Email: ".$_SESSION['email']."<br>";
?>
<?php 
include('header.php');
include('database.php');

$db = db_connect();
$counter = 1;
 
?>

<!-- input field and items load here -->
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card-header" style="margin-bottom: 10px">
            <i class="fa fa-table"></i> <strong> Sub Category Input Page</strong>
        </div>
        <form action="sub-category-process.php" method="POST" enctype="multipart/form-data">
            <div class="form-group col-md-4">
                <label for="formGroupExampleInput">Enter New Sub Category</label>
                <input type="text" name="title" class="form-control" id="formGroupExampleInput" placeholder="Sub Category Name" required >
            </div>

            <div class="form-group col-md-4">
                <label for="Category">Select a category</label>
                <select class="form-control" name="category_id" required >
                    <option>Choose A Category</option>
                    <?php
                    if ($db) {
                        $sql = "SELECT `id`,`title` FROM `categories` ";
                        $result = mysqli_query($db,$sql);
                    }     
                    if (mysqli_num_rows($result) > 0) {
                        while ( $categories = mysqli_fetch_assoc($result)){
                        ?>
                        <option value="<?php echo $categories['id']; ?>"> <?php echo $categories['title'];?></option>
                    
                    <?php  
                        } }
                    ?>            
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="exampleFormControlFile1">Upload Sub Category Image</label>
                <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <div class="form-group col-md-6">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>

    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

    <!-- Example DataTables Card-->
  
</div>

<?php include('footer.php');?>