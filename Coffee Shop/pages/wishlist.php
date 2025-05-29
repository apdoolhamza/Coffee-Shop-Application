<?php
session_start();
//Import configuration file
require_once('../admin/components/config.php');

//Import php cart library file
require_once('../vendor/php-cart-library/cart.class.php');
$cart = new Cart();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coffee Shop | Wish List</title>
<meta name="description" content="Coffee Shop...">
<!-- fav icons -->
<link rel="apple-touch-icon" href="../assets/imgs/favicon/favicon.png">
<link rel="icon" href="../assets/imgs/favicon/favicon.png">
<!-- font awesome icons file -->
<link rel="stylesheet" href="../assets/fonts/fontawesome/all.css">
<!-- css files -->
<link rel="stylesheet" href="../assets/css/app.css">
<link rel="stylesheet" href="../assets/css/itemDetails.css">
<link rel="stylesheet" href="../assets/css/cart.css">
<link rel="stylesheet" href="../assets/css/asycRequest.css">
<link rel="stylesheet" href="../assets/css/wishlist.css">
</head>
<body>

<!-- Spinner loader -->
<div class="asycRequest">
<div class="bounce1"></div>
<div class="bounce2"></div>
<div class="bounce3"></div>
</div>

<!-- container -->
<div class="wrapper">
<div class="cartHead">
<button class="backBtn historyBack center" title="Back"><i class="fas fa-chevron-left"></i></button>
<p class="cartTitle">Wish List</p>
<?php
if(empty($_SESSION['id']) && strlen($_SESSION['id']) == 0) {
    header("location:../login.php");
} else {

// check if delete btn clicked
if(isset($_GET['del'])){
$delId = intval($_GET['del']);
    
// delete selected item from db
$delQuery = mysqli_query($con,"DELETE FROM wishlist WHERE productid='$delId'");
    
if ($delQuery) {
header('location: ../index.php');
exit();
} else {
echo "<script>alert('Error!');</script>";
}
}

// check if add to cart btn clicked
if(isset($_GET['add'])){
$id = intval($_GET['add']);
        
$addQuery = mysqli_query($con,"SELECT * FROM products WHERE id='$id'");

if (mysqli_num_rows($addQuery) > 0) {

// retrieve all the matching items from db as an associative array and store them in '$row' varaible
$row = mysqli_fetch_assoc($addQuery);

// add selected item to cart
$items = [ "id" => $row["id"],
          "name" => $row["productName"],
          "price" => $row["productPrice"],
          "qty" => "1",
          "total" => ("1" * $row["productPrice"]),
          "gradient" => $row["productGradient"],
          "img" => $row["productImage"],
		];

        $cart -> add_to_cart($items);

// delete the item form wishList if it added to cart
mysqli_query($con,"DELETE FROM wishlist WHERE productid='$id'");

header("location: cart.php");
exit();

} else {
echo "<script>alert('Error!');</script>";
}
}

// retrieve all matching products from db
$query = mysqli_query($con,"SELECT * FROM products WHERE id IN (SELECT productid FROM wishlist WHERE userid ='" . $_SESSION['id'] . "')");

if (mysqli_num_rows($query) > 0) {
?>
<p class="totalOrderList">Order List: <b><span><?php echo htmlentities(mysqli_num_rows($query));?> items</b></span></p>
</div>
<div class="wishList center autoscroll">

<?php 
while ($item = mysqli_fetch_assoc($query)) {
?>
<div class="cart center">
    <div class="detailsHead center">
  <img class="cardImg" src='../admin/uploadedProductsImages/<?php echo htmlentities($item["productImage"]);?>' width="300" alt="">
    <div class="titlePrice">
        <h2 class="cardTitle"><?php echo htmlentities($item["productName"]);?></h2>
        <p class="hutColdCoffee">With <?php echo htmlentities($item["productGradient"]);?> <i class="fas fa-mug-hot"></i></p>
        <p class="price"><span>₦</span><?php echo htmlentities(number_format($item["productPrice"]));?></p>
     </div>
    </div>

    <!-- add to cart btn -->
    <a href="wishlist.php?add=<?php echo htmlentities($item['id']);?>" class="addtocart"><i class="fas fa-shopping-cart"></i> <span>ADD TO</span> CART</a>

    <div class="delete center">
    <a href="wishlist.php?del=<?php echo htmlentities($item['id']);?>"><i class="fas fa-trash-alt"></i></a>
    </div>
    </div>
    <?php }  } else { ?>
    <div class='emptyCart'><span>Wish</span> is empty!</div>
    <?php } }?>

</div>
<!-- end cartList -->

</div>

<!-- js files -->
<script src="../assets/js/autoScroll.js"></script>
<script src="../assets/js/historyBack.js"></script>
<script src="../vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>
</body>
</html>