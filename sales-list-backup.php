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
$counter = 1;
if ($db) {
    $item_sales_sql = "SELECT customers.email as email, items.title as title, items.image as image, sales.* FROM sales JOIN customers ON sales.customer_id = customers.id JOIN items ON sales.item_id = items.id GROUP BY sales.id, sales.item_id ORDER BY sales.id ASC";
    $result = mysqli_query($db,$item_sales_sql);
    $sales_group_count_sql = "SELECT id, COUNT(id) as total_items_per_sales, SUM(total_price) as total_price FROM sales GROUP BY id";
    $sales_group_count_result = mysqli_query($db, $sales_group_count_sql);
    $sales_group_count_array = array();
    while ($sales_group_count_row = mysqli_fetch_assoc($sales_group_count_result)) {
        $sales_group_count_array[$sales_group_count_row['id']] = $sales_group_count_row;
    }
}


?>

<!-- input field and items load here -->

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Sales Table
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bsalesed" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>                                
                                <th>Customer Email</th>
                                <th>Order No</th>
                                <th>Item Name</th>
                                <th>Item Image</th>
                                <th>Addons</th>
                                <th>Recipes</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Item Price</th>
                                <th>Addons Price</th>
                                <th>Item Total Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>                
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                $sales_id_check = 0;
                                $row_count = 1;
                                $sales_total_price = 0;
                                while ( $item_sales = mysqli_fetch_assoc($result)){
                                $sales_id = $item_sales['id'];
                                $item_id = $item_sales['item_id'];
                            ?> 
                            <tr>
                                <?php 
                                    if ($sales_id != $sales_id_check): 
                                ?>
                                <td <?php if ($sales_group_count_array[$item_sales['id']]['total_items_per_sales'] > 1) echo "rowspan='". $sales_group_count_array[$item_sales['id']]['total_items_per_sales'] . "'"; ?> style="vertical-align: middle;">
                                    <?php echo $item_sales['email'];?>    
                                </td>
                                <?php endif; ?>
                                <?php 
                                    if ($sales_id != $sales_id_check): 
                                ?>
                                <td <?php if ($sales_group_count_array[$item_sales['id']]['total_items_per_sales'] > 1) echo "rowspan='". $sales_group_count_array[$item_sales['id']]['total_items_per_sales'] . "'"; ?> style="vertical-align: middle;">
                                    <?php
                                        echo "#".$item_sales['id'];
                                    ?>
                                </td>
                                <?php endif; ?>
                                <td><?php echo $item_sales['title'];?></td>
                                <td><img src="images/uploads/<?php echo $item_sales['image'];?>" width="auto" height="30px"></td>
                                <td>
                                    <?php 
                                    $item_addons_sql = "SELECT addons.title as title FROM sales_addon, addons WHERE sales_addon.addon_id = addons.id AND sales_addon.order_id=$sales_id AND sales_addon.item_id= $item_id";
                                    $item_addons_result = mysqli_query($db,$item_addons_sql);
                                    if (mysqli_num_rows($item_addons_result) > 0) {
                                     while ($addon_name = mysqli_fetch_assoc($item_addons_result)) {
                                        echo " $$".$addon_name['title'];
                                    }};?>

                                </td>
                                <td>
                                    <?php 
                                    $item_recipes_sql = "SELECT recipes.title as title FROM sales_recipe, recipes WHERE sales_recipe.recipe_id = recipes.id AND sales_recipe.order_id=$sales_id AND sales_recipe.item_id= $item_id";
                                    $item_recipes_result = mysqli_query($db,$item_recipes_sql);
                                    if (mysqli_num_rows($item_recipes_result) > 0) {
                                     while ($recipe_name = mysqli_fetch_assoc($item_recipes_result)) {
                                        echo " $$".$recipe_name['title'];
                                    }};?>
                                </td>
                                <td><?php echo $item_sales['quantity'];?></td>
                                <td><?php echo $item_sales['unit_price'];?></td>
                                <td><?php echo $item_sales['item_price'];?></td>
                                <td><?php echo $item_sales['addon_price'];?></td>
                                <td>
                                    <?php
                                        echo $item_sales['total_price'];
                                    ?>
                                </td>
                                <?php 
                                    if ($sales_id != $sales_id_check): 
                                ?>
                                <td <?php if ($sales_group_count_array[$item_sales['id']]['total_items_per_sales'] > 1) echo "rowspan='". $sales_group_count_array[$item_sales['id']]['total_items_per_sales'] . "'"; ?> style="vertical-align: middle;">
                                    <?php
                                        echo $sales_group_count_array[$item_sales['id']]['total_price'];
                                    ?>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php $sales_id_check = $sales_id; } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php include('footer.php');?>