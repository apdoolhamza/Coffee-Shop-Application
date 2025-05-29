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
<link rel="stylesheet" href="../assets/css/popUp.css">
<link rel="stylesheet" href="../assets/css/cart.css">
<style>
  .usersList{
    height:calc(100vh - 10.5rem);
    margin-top:10px;
  }
  .user .userIcon{
    display:flex;
    justify-content:center;
    align-items:center;
    width:85px;
    height:85px;
    background:#171920;
    font-size:25px;
    border-radius:7px;
  color:#b85628;

}
.explore{
  color:#b85628;
  padding:8px 10px;
  background:#171920;
  border-radius:4px;
  margin:0 4px;
}
@media screen and (max-width:460px) {
  .user .userIcon{
    width:65px;
    height:65px;
    font-size:25px;
}
.userDetails{
    margin-left:7px;
}
.explore{
  padding:6px 8px;
}
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
<p class="PageIndicator"><i class="fas fa-users"></i></p>
<ul><li><a href="dashboard.php">Dashboard</a> <span>/ Users</span></li></ul>
</div>

<div class="usersList center autoscroll">
  <?php 
  $query = mysqli_query($con, "SELECT * FROM users");

  if (mysqli_num_rows($query) > 0) {
    
    while ($row = mysqli_fetch_assoc($query)) {

  ?>
<div class="user center">
    <div class="detailsHead center">
    <p class="userIcon"><i class="fas fa-user fa-2x"></i></p>
    <div class="userDetails">
        <h2 class="username"><?php echo htmlentities($row['username']); ?></h2>
        <p class="userPone" style="font-size:12px;"><?php echo htmlentities($row['userphone']); ?></p>
        <p class="userRegDate"><?php echo htmlentities($row['reg_date']); ?></p>

     </div>
    </div>
    <a class="explore" href="user-details.php?q=<?php echo htmlentities($row['id']);?>" class="viewDetails"><i class="fas fa-expand-alt"></i></a>
    <div class="delete center">
    <a data-id='<?php echo htmlentities($row['id']);?>'><i class="fas fa-trash-alt"></i></a>
</div>
</div>
<?php }} else {?>
<div class='emptyCart'><span>Users</span> is empty!</div>
<?php } ?>
</div>
</main>
</div>

<!-- js files -->
<script src="../assets/js/popUp.js"></script>
<script src="../assets/js/autoScroll.js"></script>
<script src="./components/sidebar/sidebar.js"></script>
<script src="../assets/js/login.js"></script>
<script src="../vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>
<script>
     // iterate over all deleteBtn element
     const deleteBtns = document.querySelectorAll('.delete a');
    for (let deleteBtn of deleteBtns) {
        deleteBtn.onclick = function(){
        let userid = $(this).data('id');
        $.ajax({
        type: "POST",
		    url: "ajex_validators/delete-user.php",
        data: {
            id: userid
        },
		success:function(){
      // prevent browser history change
      window.location.href = "users.php";          
    }
    })
}
}
</script>
</body>
</html>
