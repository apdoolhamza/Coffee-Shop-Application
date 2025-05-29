<?php 
session_start(); 
//Import configuration file
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
<link rel="stylesheet" href="../assets/css/popUp.css">
<style>
main{
 text-align:center;
}
.userDetails{
    margin:0 auto;
    width:15rem;
    height:calc(100vh - 9.7rem);
    margin-top:10px;
    font-family:'Gill Sans MT';
    line-height:24px;
}
.username{
    font-size:22px;
}
.reg_date{
font-size:14px;
}
.useraddress{
    height:calc(100vh - 24rem);
    margin-top:20px;
    text-align:justify;
    overflow:scroll;
}
</style>
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
        <li><i class="fas fa-home"></i> Dashboard</li>
      </a>
      <a href="products.php">
      <li class="products active"><i class="fas fa-store-alt"></i>  Products</li>
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
<p class="PageIndicator"><i class="fas fa-expand-alt"></i></p>
<ul><li><a href="products.php">Products</a> <span>/ User Details</span></li></ul>
</div>

<?php 
 if (isset($_GET['q'])) {
  $id = $_GET['q'];

$result = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");

$item = mysqli_fetch_assoc($result);
?>
<div class="userDetails">
    <img src="../assets/imgs/userAvater.png" alt="user Avater" width="130">
<p class="username"><?php echo htmlentities($item['username']); ?></p>
<p class="userphone"><?php echo htmlentities($item['userphone']); ?></p>
<p class="reg_date"><?php echo htmlentities($item['reg_date']); ?></p>
<p class="useraddress autoscroll"><?php echo htmlentities($item['useraddress']); ?></p>
</div>
<?php } else { header('location:products.php'); }?>
</main>
</div>

<!-- js files -->
<script src="../assets/js/popUp.js"></script>
<script src="../assets/js/login.js"></script>
<script src="./components/sidebar/sidebar.js"></script>
<script src="../assets/js/autoScroll.js"></script>
<script src="../vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>
</body>
</html>