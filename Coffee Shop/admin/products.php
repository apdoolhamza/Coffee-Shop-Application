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
<link rel="stylesheet" href="../assets/css/cart.css">
<link rel="stylesheet" href="../assets/css/popUp.css">
<style>
  .productsList{
    height:calc(100vh - 14.3rem);
    margin-top:7px;
  }
  .product .num{
    display:flex;
    justify-content:center;
    align-items:center;
    width:85px;
    height:85px;
    background:#171920;
    font-size:25px;
    border-radius:7px;
}
  .price span{
    color:#b85628;
  }
  .viewDetails{
    font-size:12px;
    padding:8px 10px;
    border-radius:5px;
    background-color: #b85628;
    color:white;
}
    .addBtn{
    background-color:#43c188;
    color:white;
    padding:8px 12px;
    font-size:16px;
    border-radius:4px;
    display:inline-block;
    margin-top:20px;
    font-family: 'Gill Sans MT';
}
.addBtn i{
    border:1px solid white;
    background-color: white;
    color: #4bd396;
    border-radius:50%;
    padding:4px 5px;
    margin-left:3px;
    font-size:10px;
}


@media screen and (max-width:460px) {
  .product{
    white-space:nowrap;
  }
  .product .num{
    width:65px;
    height:65px;
    font-size:25px;
}
  .viewDetails{
    font-size:10px;
    padding:8px 9px;
    margin:0 3px;
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
<p class="PageIndicator"><i class="fas fa-store-alt"></i></p>
<ul><li><a href="dashboard.php">Dashboard</a> <span>/ Products</span></li></ul>
</div>
<a href="add-products.php" class="addBtn">Add New <i class="fas fa-plus"></i></a>

<div class="productsList center autoscroll">
  <?php 
  $query = mysqli_query($con, "SELECT * FROM products");

  if (mysqli_num_rows($query) > 0) {
 
    $counter = 0;
    
    while ($row = mysqli_fetch_assoc($query)) {

    $counter ++;
  ?>
<div class="product center">
    <div class="detailsHead center">
    <p class="num"><?php echo $counter; ?></p>
    <div class="titlePrice">
        <h2 class="productName"><?php echo htmlentities($row['productName']); ?></h2>
        <p class="productGradient">With <?php echo htmlentities($row['productGradient']); ?> <i class="fas fa-mug-hot"></i></p>
        <p class="price"><span>₦</span><?php echo htmlentities(number_format($row['productPrice'])); ?></p>

     </div>
    </div>
    <a href="product-details.php?q=<?php echo htmlentities($row['id']);?>" class="viewDetails">View Details</a>
    <div class="delete center">
    <a data-id='<?php echo htmlentities($row['id']);?>'><i class="fas fa-trash-alt"></i></a>
</div>
</div>
<?php }} else {?>
<div class='emptyCart'><span>Products</span> is empty!</div>
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
        let productid = $(this).data('id');
        $.ajax({
        type: "POST",
		url: "ajex_validators/delete-product.php",
        data: {
            id: productid
        },
		success:function(){
      // prevent browser history change
      window.location.href = "products.php";          
    }
    })
}
}
</script>
</body>
</html>
