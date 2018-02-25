<?php include('session.php');?>
<?php
    if (!isLoggedIn()) {
        header("Location: login.php");
    } else echo "<br>Email: ".$_SESSION['email']."<br>";
?>
<?php 
include('header.php');
include('database.php');
include('functions.php');
 
$db = db_connect();
$counter = 1;
if($db){
    $sql = "SELECT `title`,`image` FROM `sub_categories` ORDER BY id DESC";
    $result = mysqli_query($db,$sql);   
    }   
    
?>
<!-- input field and items load here -->
<div class="content-wrapper">
    <div class="container-fluid">
      <div class="btn-group" style="margin-bottom: 10px">
          <a class="btn btn-primary" href="sub-category-entry.php">Add New Sub Category</a>
      </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

    <!-- Example DataTables Card-->
            <?php
                if (isset($_GET['sm']) && $_GET['sm'] == "success") {
                    echo "<strong>Sub Category Inserted Successfully !</strong>";
                }
            ?>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Sub Category Table</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>SI No</th>
                            <th>Sub Category Name</th>
                            <th>Sub Category Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                        while ( $result_sets = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td><?php echo $counter ++;?></td>
                            <td><?php echo $result_sets['title'];?></td>
                            <?php if ($result_sets['image'] != NULL): ?>
                                <td><img src="images/uploads/<?php echo $result_sets['image']; ?>" width="auto" height="30px"></td>
                            <?php else: ?>
                                <td>No Image Available</td>
                            <?php endif; ?>
                            <td>
                                <span data-toggle="tooltip" data-placement="top" title="Edit this row" style="margin-right: 5px;"><a href="#"><i class="fa fa-pencil-square-o"></i></span></a></span>
                                <span data-toggle="tooltip" data-placement="top" title="Delete this row" style="margin-left: 5px;"><a href="#"><i class="fa fa-times"></i></span></a></span>
                            </td>
                        </tr>
                        <?php  } }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php');?>