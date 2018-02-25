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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sales No</th>                                
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
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>                
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                            while ( $item_orders = mysqli_fetch_assoc($result)){
                                $order_id = $item_orders['id'];
                                $item_id = $item_orders['item_id'];
                            ?> 
                            <tr>
                                <td><?php echo $counter++?></td>
                                <td><?php echo $item_orders['email'];?></td>
                                <td><?php echo "#".$item_orders['id'];?></td>
                                <td><?php echo $item_orders['title'];?></td>
                                <td><img src="images/uploads/<?php echo $item_orders['image'];?>" width="auto" height="30px"></td>
                                <td>
                                    <?php 
                                    $item_addons_sql = "SELECT addons.title as title FROM order_addon, addons WHERE order_addon.addon_id = addons.id AND order_addon.order_id=$order_id AND order_addon.item_id= $item_id";
                                    $item_addons_result = mysqli_query($db,$item_addons_sql);
                                    if (mysqli_num_rows($item_addons_result) > 0) {
                                     while ($addon_name = mysqli_fetch_assoc($item_addons_result)) {
                                        echo " $$".$addon_name['title'];
                                    }};?>

                                </td>
                                <td>
                                    <?php 
                                    $item_recipes_sql = "SELECT recipes.title as title FROM order_recipe, recipes WHERE order_recipe.recipe_id = recipes.id AND order_recipe.order_id=$order_id AND order_recipe.item_id= $item_id";
                                    $item_recipes_result = mysqli_query($db,$item_recipes_sql);
                                    if (mysqli_num_rows($item_recipes_result) > 0) {
                                     while ($recipe_name = mysqli_fetch_assoc($item_recipes_result)) {
                                        echo " $$".$recipe_name['title'];
                                    }};?>
                                </td>
                                <td><?php echo $item_orders['quantity'];?></td>
                                <td><?php echo $item_orders['unit_price'];?></td>
                                <td><?php echo $item_orders['item_price'];?></td>
                                <td><?php echo $item_orders['addon_price'];?></td>
                                <td><?php $total_price = $item_orders['item_price'] + $item_orders['addon_price'];
                                    echo "$total_price";
                                ?></td>
                                
                            </tr>
                            <?php } }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php include('footer.php');?>