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
    $sql = "SELECT * FROM customers ORDER BY id DESC";
    $result = mysqli_query($db,$sql);   
    } 
      
?>


<!-- input field and items load here -->

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Customer List Table
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>SI No</th>
                                <th>Customer Email</th>
                                <th>Mobile No</th>
                                <th>Device Name</th>
                                <th>IMEI No</th>
                                <th>Reward Point</th>
                                <!-- <th>Is Active</th> -->
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
                                <td><?php echo $result_sets['email'];?></td>
                                <td><?php echo $result_sets['mobile_no'];?></td>
                                <td><?php echo $result_sets['device_name'];?></td>
                                <td><?php echo $result_sets['imei_no'];?></td>   
                                <td><?php echo $result_sets['reward_point'];?></td>                   
                                <td>
                                    <span data-toggle="tooltip" data-placement="top" title="Edit this row" style="margin-right: 5px;"><a href="customer-edit.php?id=<?php echo $result_sets['id'];?>"><i class="fa fa-pencil-square-o"></i></span></a></span>
                                    <span data-toggle="tooltip" data-placement="top" title="Delete this row" style="margin-left: 5px;"><a href="customer-delete-process.php?id=<?php echo $result_sets['id'];?>" onclick="return confirm('Are u sure want to delete this customer?')"><i class="fa fa-times"></i></span></a></span>
                                </td>
                            </tr>
                        <?php } }?>    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php include('footer.php');?>