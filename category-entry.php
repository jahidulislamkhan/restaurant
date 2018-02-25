<?php include('session.php');?>
<?php
    if (!isLoggedIn()) {
        header("Location: login.php");
    } else echo "<br>Email: ".$_SESSION['email']."<br>";
?>
<?php include('header.php');?>
<?php include('database.php');
$db = db_connect();
?>
<!-- input field and items load here -->

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card-header" style="margin-bottom: 10px">
            <i class="fa fa-table"></i> <strong> Category Input Page</strong>
        </div>
        <form action="category-process.php" method="POST" enctype="multipart/form-data">
            <div class="form-group col-md-4">
                <label for="formGroupExampleInput">Enter New Category</label>
                <input type="text" name="title" class="form-control" id="formGroupExampleInput" placeholder="Category Name" required >
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlFile1">Upload Category Image</label>
                <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlSelect1">Select Addons</label>
                <select name="addon[]" class="form-control selectpicker" data-live-search="true" title="Choose Addons" multiple required>
                        <?php 
                        if ($db) {
                        $sql = "SELECT `id`,`title` FROM `addons` ";
                        $result = mysqli_query($db,$sql);   
                        }
                        if (mysqli_num_rows($result) > 0) {
                            while ( $addons = mysqli_fetch_assoc($result)){
                            ?>
                            <option value="<?php echo $addons['id']; ?>"> <?php echo $addons['title'];?></option>
                            <?php  } }
                            ?>   
                </select>
            </div>
            <div class="form-group col-md-6">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
    <!-- Example DataTables Card-->
    
<?php include('footer.php');?>