<?php
session_start();
//Import configuration file
require_once('../admin/components/config.php');

require_once('../vendor/php-cart-library/cart.class.php');
$cart = new Cart();

if(empty($_SESSION['id']) && strlen($_SESSION['id']) == 0) {
    header("location:../login.php");
}

// check if pay now btn clicked
if (isset($_POST['payNowBtn'])) {

$items = $cart->get_all_items();
    
foreach($items as $item){

    $query = mysqli_query($con, "INSERT INTO users_order(userid,productid,quantity) VALUES('".$_SESSION['id']."','".$item['id']."','".$item['qty']."')");
}
    if ($query) {
     // remove all items from cart
     $cart -> destroy();

     header('location:../index.php');
     exit();
    } else {
     echo "<script>alert('Error!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coffee Shop | CheckOut</title>
<!-- fav icons -->
<link rel="apple-touch-icon" href="../assets/imgs/favicon/favicon.png">
<link rel="icon" href="../assets/imgs/favicon/favicon.png">
<!-- font awesome icons file -->
<link rel="stylesheet" href="../assets/fonts/fontawesome/all.css">
<!-- css files -->
<link rel="stylesheet" href="../assets/css/app.css">
<link rel="stylesheet" href="../assets/css/itemDetails.css">
<link rel="stylesheet" href="../assets/css/asycRequest.css">
<link rel="stylesheet" href="../assets/css/checkout.css">
<link rel="stylesheet" href="../assets/css/popUp.css">
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
<div class="checkOutHeader">
    <button class="backBtn historyBack center" title="Back"><i class="fas fa-chevron-left"></i></button>
    <div id="totalCost">
        <p><small>Total Cost</small> <br> <span>NGN <?php echo number_format($cart->get_cart_total(), 2);?></span></p>
    </div>
    </div>

    <div class="checkOutCards center">
    <img class="active" title="Visa Card" src="../assets/imgs/Visa.png" alt="Visa Card" width="80" value="1">
    <img title="Master Card" src="../assets/imgs/Master.png" alt="Master Card" width="50" value="2">
    <img title="Verve Card" src="../assets/imgs/Verve.png" alt="Verve Card" width="90" value="3">
    </div>

    <form action="" method="post" class="checkoutForm center" novalidate>
        <div class="cardNumContainer">
        <label for="cardNumber">Card Number</label>
        <input type="text" name="cardNumber" id="cardNumber" placeholder="XXXX XXXX XXXX XXXX" maxlength="19" required> <img src="../assets/imgs/Visa.png" alt="Card">
        </div>
        <div class="expdateCVVContainer">
        <div class="expdate">
        <label for="expdate">Exp. Date</label>
        <input type="text" name="expdate" id="expdate" maxlength="7" required placeholder="MM / YY">
        </div>
        <div class="cvv">
        <label for="cvv">CVV</label>
        <input type="text" name="cvv" id="cvv" placeholder="XXX" maxlength="3" required>
        </div>
        </div>
        <div class="cardHolderContainer">
        <label for="cardHolder">Card Holder</label>  
        <input type="text" name="cardHolder" style="text-transform:uppercase;" id="cardHolder" maxlength="25" placeholder="eg. APDOOL HAMZA" required>
        </div>
        <div>
        <button title="Pay Now!" id="payNowBtn" name="payNowBtn" onclick="validateInputs();" type="submit">PAY NOW</button>
        </div>
    </form>

</div>

<!-- js files -->
<script src="../assets/js/popUp.js"></script>
<script src="../assets/js/checkout.js"></script>
<script src="../assets/js/historyBack.js"></script>
<script src="../vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>
</body>
</html>