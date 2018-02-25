<?php include('session.php');?>
<?php
	if (!isLoggedIn()) {
		header("Location: login.php");
	} else echo "<br>Email: ".$_SESSION['email']."<br>";
?>
<?php include('header.php');?>

  <div class="content-wrapper">
    <div class="container-fluid">   
        <div class="row">
            <div class="col-md-12">                
                <img class="rounded mx-auto d-block" src="images/logo/logo.png" height="80px" class="rounded" alt="Revive Logo">        
            </div>
        </div>          
        <div class="row">
            <div class="col-md-12">
                <h3 class="font-weight-bold text-center">WELCOME TO ADMIN PANEL</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="font-weight-bold text-center"><i class="fa fa-hourglass-end"></i></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="font-weight-bold text-center text-danger">Running Order : 2</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-dark">Manage Sales</button>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-12">
              <div class="col-md-3">
                <i class="fa fa-users"></i>
                <p class="text-center"><strong>Total Customer : 522</strong></p>
              </div>
              <div class="col-md-3">
                <i class="fa fa-users"></i>
                <p class="text-center"><strong>Total Customer : 522</strong></p>
              </div>
              <div class="col-md-3">
                <i class="fa fa-users"></i>
                <p class="text-center"><strong>Total Customer : 522</strong></p>
              </div>
                
            </div>
        </div> -->        
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

<?php include('footer.php');?>    