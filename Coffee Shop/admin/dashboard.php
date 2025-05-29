<?php
session_start();
// import configuration file
require_once('components/config.php');

if(empty($_SESSION['adminId']) && strlen($_SESSION['adminId']) == 0) {
    header("location:index.php");
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coffee Shop | Dashboard</title>
<meta name="description" content="Coffee Shop...">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- fav icon -->
<link rel="apple-touch-icon" href="../assets/imgs/favicon/favicon.png">
<link rel="icon" href="../assets/imgs/favicon/favicon.png">
<!-- icons file -->
<link rel="stylesheet" href="../assets/fonts/fontawesome/all.css">
<!-- css files -->
<link rel="stylesheet" href="../assets/css/asycRequest.css">
<link rel="stylesheet" href="./assets/css/header.css">
<link rel="stylesheet" href="./assets/css/dashboard.css">
<link rel="stylesheet" href="./components/sidebar/sidebar.css">
</head>
<body>
<!-- header -->
<?php
include_once('./components/header.php');
?>

<!-- sidebar & main container -->
<div class="sidebarMian">
<!-- sidebar -->
<div class="sidebar">
    <p class="hideSidebarBtn center" title="Close"><i class="fas fa-chevron-left"></i></p>
<nav>
    <ul>
      <a href="dashboard.php">
        <li class="active"><i class="fas fa-home"></i> Dashboard</li>
      </a>
      <a href="products.php">
      <li class="products"><i class="fas fa-store-alt"></i>  Products</li>
      </a>
      <a href="update-credantial.php">
      <li><i class="fas fa-gear"></i>  Setting</li>
      </a>
      <a href="logout.php">
        <li><i class="fas fa-sign-out-alt"></i> Sign Out</li>
      </a>
</ul>
</nav>
</div>
<!-- main -->
<main>
<div class="head center">
<p class="PageIndicator"><i class="fas fa-home"></i></p>
<ul><li><a href="dashboard.php">Dashboard</a> <span>/ Home</span></li></ul>
</div>

<div class="cards-container autoscroll">
    <div class="card-box center">
        <i id="box-icon" class="fas fa-store-alt"></i>
        <div class="desc">
            <p>Total Products</p>
            <?php $query = mysqli_query($con, "SELECT * FROM products");
            ?>
            <p class="views"><?php echo htmlentities(mysqli_num_rows($query));?></p>
            <a href="products.php">View Details</a>
        </div>
    </div>

    <div class="card-box center">
        <i id="box-icon" class="fas fa-shopping-bag"></i>
        <div class="desc">
            <p>Total Order</p>
            <?php $odersQuery = mysqli_query($con, "SELECT * FROM users_order");
            ?>
            <p class="views"><?php echo htmlentities(mysqli_num_rows($odersQuery)); ?></p>
            <a href="orders.php">View Details</a>
        </div>
    </div>

    <div class="card-box center">
        <i id="box-icon" class="fas fa-users"></i>
        <div class="desc">
            <p>Total Users</p>

            <?php $result = mysqli_query($con, "SELECT * FROM users");
            ?>
            <p class="views"><?php echo htmlentities(mysqli_num_rows($result)); ?></p>
            <a href="users.php">View Details</a>
        </div>
    </div>


</div>
</main>
</div>

<!-- js files -->
<script src="./components/sidebar/sidebar.js"></script>
<script src="../assets/js/autoScroll.js"></script>
<script src="../vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>
</body>
</html>
