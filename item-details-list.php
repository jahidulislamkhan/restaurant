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
if ($db) {
$sql = "SELECT `id`, `title`, `image`, `price`, `details` FROM `items` ORDER BY id DESC";
$result = mysqli_query($db,$sql);   
}  

// $recipe_sql = "SELECT `title` FROM `recipes` ";
// $recipe_result = mysqli_query($db,$recipe_sql);   
 
?>

<!-- input field and items load here -->
<div class="content-wrapper">
    <div class="container-fluid">    
        <div class="btn-group" style="margin-bottom: 10px">
            <a class="btn btn-primary" href="item-details-entry.php">Add New Item</a>
        </div>
        <?php
            if (isset($_GET['sm']) && $_GET['sm'] == "success") {
                echo "<strong>Item Inserted Successfully !</strong>";
            }
        ?>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Item Details Table
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>SI No</th>
                                <th>Item Name</th>
                                <th>Item Image</th>
                                <th>Item Price</th>                                    
                                <th>Item Recipes</th>
                                <th>Item Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                            while ( $result_set = mysqli_fetch_assoc($result)){
                            ?>                   
                            <tr>
                                <td><?php echo $counter ++;?></td>
                                <td><?php echo $result_set['title'];?></td>                                
                                <?php if ($result_set['image'] != NULL): ?>
                                <td><img src="images/uploads/<?php echo $result_set['image'];?>" width="auto" height="30px"></td>
                                <?php else: ?>
                                <td>No Image Available</td>
                                <?php endif; ?>
                                <td><?php echo "$".$result_set['price'];?></td>
                                <td>
                                    <?php
                                    $sql2 = "SELECT recipes.* FROM item_recipe, recipes where item_recipe.item_id = $result_set[id] and item_recipe.recipe_id = recipes.id";
                                    $result2 = mysqli_query($db,$sql2);
                                    while ( $result_set2 = mysqli_fetch_assoc($result2)){
                                        echo " $$".$result_set2['title'];
                                    }
                                    ?>
                                </td>
                                <td style="max-width: 70px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;"><?php echo $result_set['details'];?>                                    
                                </td>
                                <td>
                                    <span data-toggle="tooltip" data-placement="top" title="Edit this row" style="margin-right: 5px;"><a href="item-details-edit.php?id=<?php echo $result_set['id'];?>"><i class="fa fa-pencil-square-o"></i></span></a></span>
                                    <span data-toggle="tooltip" data-placement="top" title="Delete this row" style="margin-left: 5px;"><a href="item-details-delete-process.php?id=<?php echo $result_set['id'];?>"><i class="fa fa-times"></i></span></a></span>
                                </td>
                            </tr>
                            <?php } } ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

<?php include('footer.php');?>