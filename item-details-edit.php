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
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $item_sql = "SELECT title, image, price, details, category_id, sub_category_id FROM items WHERE id = $id";
    $result = mysqli_query($db,$item_sql);
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
    $image = $row['image'];
    $price = $row['price'];
    $details = $row['details'];
    $category_id = $row['category_id'];
    $sub_category_id = $row['sub_category_id'];
}  
 
?> 

?>
<!-- input field and items load here -->
  <div class="content-wrapper">
    <div class="container-fluid">
        <div class="card-header" style="margin-bottom: 10px">
                <i class="fa fa-table"></i><strong> Item Edit Page</strong>
        </div>  
    
        <form action="item-details-process.php" method="POST" enctype="multipart/form-data">
            <div class="form-group col-md-6">
                    <label for="exampleFormControlInput1">Enter Item Name</label>
                    <input type="text" name="title" class="form-control" value="<?php echo $title;?>" required >
            </div>
            <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Select Category</label>
                <select  name="category_id" required class="form-control" id="exampleFormControlSelect1" >
                        <option>Choose Category</option>
                            <?php 
                            if ($db) {
                                $sql = "SELECT `id`, `title` FROM `categories` ";
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
            <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Select Sub-Category</label>
                <select  name="sub_category_id"  class="form-control" id="exampleFormControlSelect1" >
                        <option value="0">Choose Sub Category</option>
                            <?php 
                            if ($db) {
                                $sql = "SELECT `id`, `title` FROM `sub_categories` ";
                                $result = mysqli_query($db,$sql);   
                            }
                            if (mysqli_num_rows($result) > 0) {
                                while ( $sub_categories = mysqli_fetch_assoc($result)){
                                ?>
                                <option value="<?php echo $sub_categories['id']; ?>"> <?php echo $sub_categories['title'];?></option>
                            <?php  
                                } }
                            ?>                            
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlFile1">Upload Item Image</label>
                <input type="file" name="image" class="form-control-file" value="<?php echo $image;?>">
            </div>
            <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Select Recipe</label>
                <select name="recipe[]" class="form-control selectpicker" data-live-search="true" title="Choose Recipes" multiple required >
                        <?php 
                        if ($db) {
                        $sql = "SELECT `id`,`title` FROM `recipes` ";
                        $result = mysqli_query($db,$sql);   
                            }
                        if (mysqli_num_rows($result) > 0) {
                            while ( $recipes = mysqli_fetch_assoc($result)){
                            ?>
                            <option value="<?php echo $recipes['id']; ?>"> <?php echo $recipes['title'];?></option>
                            <?php  } }
                            ?>   
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleFormControlInput1">Enter Food Price</label>
                <input type="text" name="price" class="form-control" value="<?php echo $price;?>" required >
            </div>
            <div class="form-group col-md-6">
                <label for="exampleFormControlInput1">Enter Food Details</label>
                <textarea class="form-control" name="details" rows="2" value="<?php echo $details;?>"></textarea>
            </div>
            <div class="form-group col-md-6">
                <input type="submit" name="submit" class="btn btn-primary text-center" value="Submit">
            </div>         
        </form>
      
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

<?php include('footer.php');?>