
<?php include('header.php');?>
<?php include('database.php');
$db = db_connect();
if ($db) {
    $item_order_sql = "SELECT customers.email as email, items.title as title, items.image as image, orders.* FROM orders JOIN customers ON orders.customer_id = customers.id JOIN items ON orders.item_id = items.id GROUP BY orders.id, orders.item_id ORDER BY orders.id ASC";

    $result = mysqli_query($db,$item_order_sql);

    $order_group_count_sql = "SELECT id, COUNT(id) as total_items_per_order, SUM(total_price) as total_price FROM orders GROUP BY id";
    $order_group_count_result = mysqli_query($db, $order_group_count_sql);
    $order_group_count_array = array();
    while ($order_group_count_row = mysqli_fetch_assoc($order_group_count_result)) {
        $order_group_count_array[$order_group_count_row['id']] = $order_group_count_row;
    }
    
}

?>
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card-header" style="margin-bottom: 10px">
            <i class="fa fa-table"></i> <strong> Category Input Page</strong>
        </div>



<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <div class="modal-body">
                  <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Order Table
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered"  width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Order Status</th>
                                <th>Email</th>
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
                                $order_id_check = 0;
                                $row_count = 1;
                                $order_total_price = 0;
                                while ( $item_orders = mysqli_fetch_assoc($result)){
                                $order_id = $item_orders['id'];
                                $item_id = $item_orders['item_id'];
                            ?> 
                            <tr>
                                <?php 
                                    if ($order_id != $order_id_check): 
                                ?>
                                <td <?php if ($order_group_count_array[$item_orders['id']]['total_items_per_order'] > 1) echo "rowspan='". $order_group_count_array[$item_orders['id']]['total_items_per_order'] . "'"; ?> style="vertical-align: middle;">
                                    <?php if ($item_orders['status'] == 1): ?>
                                        <form action="sales-confirm-process.php" method="POST">
                                            <div class="form-group">                                        
                                                <input type="hidden" name="order_id" value="<?php echo $order_id;?>">
                                                <input type="submit" name="confirm" class="btn btn-primary btn-sm" value="Confirm">
                                            </div>
                                        </form>
                                        <form action="order-cancel-process.php" method="POST">
                                            <div class="form-group">                                        
                                                <input type="hidden" name="order_id" value="<?php echo $order_id;?>">
                                                <input type="submit" name="cancel" class="btn btn-primary btn-sm" value="Cancel">
                                            </div>
                                        </form>
                                    <?php elseif($item_orders['status'] == 2): ?>
                                        <p class="font-weight-bold">Delivered</p>
                                    <?php elseif($item_orders['status'] == 3): ?>
                                        <p class="font-weight-bold">Canceled</p>
                                    <?php else : ?>
                                        <p class="font-weight-bold">Something Wrong!!</p>
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>
                                <?php 
                                    if ($order_id != $order_id_check): 
                                ?>
                                <td <?php if ($order_group_count_array[$item_orders['id']]['total_items_per_order'] > 1) echo "rowspan='". $order_group_count_array[$item_orders['id']]['total_items_per_order'] . "'"; ?> style="vertical-align: middle;">
                                    <?php echo $item_orders['email'];?>    
                                </td>
                                <?php endif; ?>
                                <?php 
                                    if ($order_id != $order_id_check): 
                                ?>
                                <td <?php if ($order_group_count_array[$item_orders['id']]['total_items_per_order'] > 1) echo "rowspan='". $order_group_count_array[$item_orders['id']]['total_items_per_order'] . "'"; ?> style="vertical-align: middle;">
                                    <?php
                                        echo "#".$item_orders['id'];
                                    ?>
                                </td>
                                <?php endif; ?>
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
                                <td>
                                    <?php
                                        echo $item_orders['total_price'];
                                    ?>
                                </td>
                                <?php 
                                    if ($order_id != $order_id_check): 
                                ?>
                                <td <?php if ($order_group_count_array[$item_orders['id']]['total_items_per_order'] > 1) echo "rowspan='". $order_group_count_array[$item_orders['id']]['total_items_per_order'] . "'"; ?> style="vertical-align: middle;">
                                    <?php
                                        echo $order_group_count_array[$item_orders['id']]['total_price'];
                                    ?>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php $order_id_check = $order_id; } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <p>content</p>
      <p>content</p>
      <p>content</p>
      <p>content</p>
      <p>content</p>
      <p>content</p>
      <p>content</p>
    </div>
  </div>
</div> -->
<?php include('footer.php');?>