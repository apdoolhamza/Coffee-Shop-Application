<?php
session_start();
//Import configuration file
require_once('../admin/components/config.php');

//Import php cart library file
require_once('../vendor/php-cart-library/cart.class.php');
$cart = new Cart();

// chech if add to cart btn clicked
if(isset($_POST["submitToCart"])){

    // chech if user login
    if(empty($_SESSION['id']) && strlen($_SESSION['id']) == 0) {
        header("location:../login.php");
    } else {
$items = [ "id" => $_POST["id"],
          "name" => $_POST["name"],
          "price" => $_POST["price"],
          "qty" => "1",
          "total" => ("1" * $_POST["price"]),
          "gradient" => $_POST["gradient"],
          "img" => $_POST["img"],
		];
        $cart -> add_to_cart($items);
        header("location: ../index.php");
        exit();
	}}
	
// chech if add to wishList btn clicked
    if(isset($_POST["submitToWish"])){

    // chech if user login
        if(empty($_SESSION['id']) && strlen($_SESSION['id']) == 0) {
            header("location:../login.php");
        } else {

    if(isset($_GET['q'])){

    $id = intval($_GET['q']);

    $query = mysqli_query($con,"SELECT * FROM wishlist WHERE userid='".$_SESSION['id']."' AND productid='$id'");

    if (mysqli_num_rows($query) > 0) {
    header("location: ../index.php");
    exit();
    } else {
    $result = mysqli_query($con, "INSERT INTO wishlist (userid,productid) VALUES('" . $_SESSION['id'] . "','$id')");
    if ($result) {
    header("location: ../index.php");
    exit();
    } else {
    echo "<script>alert('Error!');</script>";
    };
   }
   }}}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coffee Shop | Coffee Details</title>
<meta name="description" content="Coffee Shop...">
<!-- fav icons -->
<link rel="apple-touch-icon" href="../assets/imgs/favicon/favicon.png">
<link rel="icon" href="../assets/imgs/favicon/favicon.png">
<!-- font awesome icons file -->
<link rel="stylesheet" href="../assets/fonts/fontawesome/all.css">
<!-- css files -->
<link rel="stylesheet" href="../assets/css/app.css">
<link rel="stylesheet" href="../assets/css/asycRequest.css">
<link rel="stylesheet" href="../assets/css/itemDetails.css">
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
    <div class="itemHeader">
    <button style="box-shadow:0 0 2px 1px #cd6332;" class="backBtn historyBack center" title="Back"><i class="fas fa-chevron-left"></i></button>

    <?php
    if(isset($_GET['q'])){

        $id = intval($_GET['q']);


        $query = "SELECT id,productImage,productName,productGradient,productPrice,productDescription FROM products WHERE id = '$id'";

        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($result)) {

    ?>
    <img id="itemImg" src="../admin/uploadedProductsImages/<?php echo htmlentities($row['productImage']);?>"  alt="Coffee Image">

    </div>

    <div class="itemDetails">
        <div class="detailsHead center">
        <h2 class="cardTitle"><?php echo htmlentities($row['productName']);?></h2>
        <p class="price"><span>₦</span><?php echo htmlentities($row['productPrice']);?></p>
    </div>
    <div class="hutColdReview center">
    <p class="hutColdCoffee">Hot Coffee<span>With <?php echo htmlentities($row['productGradient']);?> <i class="fas fa-mug-hot"></i></span></p>
    <p class="reviews center"><i class="fas fa-star"></i> 0.0<span>(00 Stars)</span></p>
    </div>
    <div class="itemDescription autoscroll" draggable="false">
    <p><?php echo htmlentities($row['productDescription']);?></p>
   </div>
    </div>

    <div class="cartFavBtns center">

    <!-- add to cart form -->
    <form method='post' class="addToCartForm" action='<?php echo $_SERVER["REQUEST_URI"];?>'>
    <input type='hidden' name='id' value='<?php echo htmlentities($row['id']);?>'>
    <input type='hidden' name='img' value='<?php echo htmlentities($row['productImage']);?>'>
    <input type='hidden' name='name' value='<?php echo htmlentities($row['productName']);?>'>
    <input type='hidden' name='price' value='<?php echo htmlentities($row['productPrice']);?>'>
    <input type='hidden' name='gradient' value='<?php echo htmlentities($row['productGradient']);?>'>
    <button type='submit' name='submitToCart' class="addToCartBtn center" title="Add To Cart">Add to cart</button>
	</form>

    <!-- add to wishList form -->
    <form method='post' class="addToWishForm" action='<?php echo $_SERVER["REQUEST_URI"];?>'>
    <button type='submit' name='submitToWish' class="addToFavBtn center" title="Add To Wish List"><i class="fas fa-heart"></i></button>
	</form>

    </div>
</div>
<?php }} else { header("location:../index.php");}?>
<!-- js files -->
<script src="../assets/js/autoScroll.js"></script>
<script src="../assets/js/historyBack.js"></script>
<script src="../vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>
</body>
</html>