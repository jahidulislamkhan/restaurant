<?php include('session.php');?>
<?php
    if (!isLoggedIn()) {
        header("Location: login.php");
    } else echo "<br>Email: ".$_SESSION['email']."<br>";
?>
<?php include('header.php');?>

<!-- input field and items load here -->

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card-header" style="margin-bottom: 10px">
            <i class="fa fa-table"></i> <strong> Recipe Input Page</strong>
        </div>
        <form action="recipe-process.php" method="POST" enctype="multipart/form-data">
            <div class="form-group col-md-4">
                <label for="formGroupExampleInput">Enter New Recipe</label>
                <input type="text" name="title" class="form-control" id="formGroupExampleInput" placeholder="Recipe Name" required>
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlFile1">Upload Recipe Image</label>
                <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <div class="form-group col-md-6">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    
</div>
<?php include('footer.php');?>