<?php
session_start();
error_reporting(0);
//Import configuration file
require_once('admin/components/config.php');

//Import php cart library file
require_once('./vendor/php-cart-library/cart.class.php');
$cart = new Cart();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coffee Shop | Home</title>
<meta name="description" content="Coffee Shop...">
<!-- fav icons -->
<link rel="apple-touch-icon" href="./assets/imgs/favicon/favicon.png">
<link rel="icon" href="./assets/imgs/favicon/favicon.png">
<!-- font awesome icons file -->
<link rel="stylesheet" href="./assets/fonts/fontawesome/all.css">
<!-- css files -->
<link rel="stylesheet" href="./assets/css/app.css">
<link rel="stylesheet" href="./components/sidebar/sidebar.css">
<link rel="stylesheet" href="./assets/css/asycRequest.css">
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
<!-- sidebar container -->
<?php
include_once('./components/sidebar/sidebar.php');
?>

<!-- header -->
<header>
    <div class="navCartBtns center">
    <div class="navBtn" title="Menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <a href="./pages/cart.php" title="Cart"><svg width="33px" height="33px" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4.46785 10.2658C4.47574 10.3372 4.48376 10.4094 4.49187 10.4823L4.61751 11.6131C4.7057 12.4072 4.78218 13.0959 4.91562 13.6455C5.05917 14.2367 5.29582 14.7937 5.78931 15.2354C6.28281 15.6771 6.86251 15.8508 7.46598 15.9281C8.02694 16.0001 8.71985 16 9.51887 16H14.8723C15.4201 16 15.9036 16 16.3073 15.959C16.7448 15.9146 17.1698 15.8162 17.5785 15.5701C17.9872 15.324 18.2731 14.9944 18.5171 14.6286C18.7422 14.291 18.9684 13.8637 19.2246 13.3797L21.7141 8.67734C22.5974 7.00887 21.3879 4.99998 19.5 4.99998L9.39884 4.99998C8.41604 4.99993 7.57525 4.99988 6.90973 5.09287C6.5729 5.13994 6.24284 5.21529 5.93326 5.34375L5.78941 4.04912C5.65979 2.88255 4.67375 2 3.5 2H3C2.44772 2 2 2.44771 2 3C2 3.55228 2.44772 4 3 4H3.5C3.65465 4 3.78456 4.11628 3.80164 4.26998L4.46785 10.2658Z" fill="#fff"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M14 19.5C14 18.1193 15.1193 17 16.5 17C17.8807 17 19 18.1193 19 19.5C19 20.8807 17.8807 22 16.5 22C15.1193 22 14 20.8807 14 19.5Z" fill="#fff"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M5 19.5C5 18.1193 6.11929 17 7.5 17C8.88071 17 10 18.1193 10 19.5C10 20.8807 8.88071 22 7.5 22C6.11929 22 5 20.8807 5 19.5Z" fill="#fff"/>
</svg><span class="cartAlert"></span></a>
<?php if ($cart -> get_cart_total() > 0) {
   echo "<style>.cartAlert{display:block;}</style>";
} else {
   echo "<style>.cartAlert{display:none;}</style>";
}?>

<?php
$query = mysqli_query($con,"SELECT * FROM products WHERE id IN (SELECT productid FROM wishlist WHERE userid ='" . $_SESSION['id'] . "')");
      
if (mysqli_num_rows($query) > 0) {
echo "<style>.wishListBtn span{display:block;}</style>";
} else {
echo "<style>.wishListBtn span{display:none;}</style>";
}
?>

    </div>
    <h2>Find the best<br>coffee for you</h2>
    <input type="search" name="search" id="search" maxlength="10" placeholder="Search..." spellcheck="false" autocapitalize="off" autocomplete="off"><p class="searchBtn"><i class="fas fa-search"></i></p>
    <div class="coffeeCategory center">
    <p class="center active">Hot Coffee <i class="fas fa-mug-hot"></i></p>
    <p class="center">Cold Coffee <i class="fas fa-mug-saucer"></i></p>
    </div>
</header>

<!-- products container -->
<main draggable="false" class="itemsContainer autoscroll"></main>
</div>

<!-- js files -->
<script src="./assets/js/app.js"></script>
<script src="./components/sidebar/sidebar.js"></script>
<script src="./assets/js/autoScroll.js"></script>
<script src="./vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="./assets/js/asycRequest.js"></script>
<script>
// search products live
function load_data(query) {
jQuery.ajax({
url: "search-products.php",
data:{query:query},
method: "POST",
success: function(response){
    $('.itemsContainer').html(response);

    // hide loader
    $('.asycRequest').hide();
},
error: function (){}
})
};

$('#search').keyup(function(){
    let thisValue = $(this).val();
    if (thisValue != "") {
        load_data(thisValue);
    } else {
        load_data();
    }
})

load_data();
</script>
</body>
</html>