<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Revive Juice Co</title>
    <!-- Favicon Image-->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Page level plugin CSS-->
    <link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Bootstrap select plugin CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap-select.css">
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <!-- <li class="nav-item">
                    <a class="nav-link" href="index.php"><img src="images/logo/logo.png" width="100px" height="auto" class="rounded" alt=""></a>
                </li>  -->               
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="index.php">
                        <i class="fa fa-dashboard"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <!-- Navigation test menu submenu start-->                    
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
                            <i class="fa fa-usd"></i>
                            <span class="nav-link-text">Manage Sales</span>
                          </a>
                          <ul class="sidenav-second-level collapse" id="collapseMulti">
                            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Food Details">
                                <a class="nav-link" href="order-list.php">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="nav-link-text">New Orders</span>                                
                                </a>
                            </li>
                            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Food Details">
                                <a class="nav-link" href="sales-list.php">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="nav-link-text">Sales List</span>                                
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-bar-chart"></i>
                                    <span class="nav-link-text">Sales Report</span>
                                </a>
                            </li>
                            <li>
                              <a href="#">
                                <i class="fa fa-trash-o"></i>
                                <span class="nav-link-text">Void Sales</span>
                              </a>
                            </li>
                          </ul>
                        </li>
                <!-- Navigation test menu submenu start-->    
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseItems" data-parent="#exampleAccordion">
                    <i class="fa fa-th-list"></i>
                    <span class="nav-link-text">Manage Items</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseItems"> 

                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Food Details">
                            <a class="nav-link" href="item-details-list.php">
                                <i class="fa fa-cutlery"></i>
                                <span class="nav-link-text">Item Details</span>
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Food Details">
                            <a class="nav-link" href="category-list.php">
                                <i class="fa fa-cutlery"></i>
                                <span class="nav-link-text">Category</span>
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Food Details">
                            <a class="nav-link" href="sub-category-list.php">
                                <i class="fa fa-cutlery"></i>
                                <span class="nav-link-text">Sub Category</span>
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Food Details">
                            <a class="nav-link" href="recipe-list.php">
                                <i class="fa fa-cutlery"></i>
                                <span class="nav-link-text">Recipe</span>
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Food Details">
                            <a class="nav-link" href="addon-list.php">
                                <i class="fa fa-cutlery"></i>
                                <span class="nav-link-text">Addon</span>
                            </a>
                        </li>                         
                    </ul>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Food Details">
                    <a class="nav-link" href="customer-list.php">
                        <i class="fa fa-user"></i>
                        <span class="nav-link-text">Manage Customer</span>
                    </a>
                </li>           
            </ul>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout-process.php" onclick="return confirm('Are u sure want to Logout?')">
                        <i class="fa fa-sign-out"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>