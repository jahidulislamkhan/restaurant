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
?>

<!-- input field and items load here -->

<div class="content-wrapper">
    <div class="container-fluid">
       <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Last 30 Days Sales Report
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>                                
                                <th>Date</th>
                                <th>Order No</th>
                                <th>Total Price</th>
                                
                            </tr>
                        </thead>
                        <tbody>                
                            <?php
                                if ($db) {
                                $sql = "SELECT id,total_price,sales_date FROM sales WHERE sales_date BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
                                $result = mysqli_query($db,$sql); 
                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $total_price = $row['total_price'];
                                $sales_date = $row['sales_date'];
                                $sql2 = "SELECT SUM(total_price) as sub_total FROM sales WHERE sales_date BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
                                $result2 = mysqli_query($db,$sql2);
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    $sub_total = $row2['sub_total'];
                                }
                                
                                                                   
                            ?>
                            <tr>
                                <td><?php echo $sales_date;?></td>
                                <td><?php echo $id;?></td>
                                <td><?php echo $total_price;?></td>
                            </tr>
                            
                            <?php  } } }?>    
                            <tr>
                                <td>Total Sales</td>
                                <td colspan="2"><?php echo $sub_total;?></td> 
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
                  
        
<?php include('footer.php');?>