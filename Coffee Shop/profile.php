<?php
//Import php cart library file
require_once('./vendor/php-cart-library/cart.class.php');
$cart = new Cart();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coffee Shop | User Profile</title>
<meta name="description" content="Coffee Shop...">
<!-- fav icons -->
<link rel="apple-touch-icon" href="./assets/imgs/favicon/favicon.png">
<link rel="icon" href="./assets/imgs/favicon/favicon.png">
<!-- font awesome icons file -->
<link rel="stylesheet" href="./assets/fonts/fontawesome/all.css">
<!-- css files -->
<link rel="stylesheet" href="./assets/css/app.css">
<link rel="stylesheet" href="./assets/css/asycRequest.css">
<link rel="stylesheet" href="./assets/css/itemDetails.css">
<style>
    img{
        width:150px;
    }
    .userDetails{
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
        width:17rem;
        margin:0 auto;
        text-align:center;
        font-family: 'Gill Sans MT';
        height:calc(100vh - 1.5rem);
        overflow:scroll;
    }
    .userName{
        font-size:22px;
        margin-bottom:10px;
    }
    .userJoinDate{
        font-size:15px;
        color:#e6e6e6;
    }
    .backBtn{
        top:5px;
        left:5px;
    }
    .cartWishList{
        width:15rem;
        height:4.5rem;
        border-radius:10px;
        display:flex;
        justify-content:space-around;
        align-items:center;
        background:#fff;
        margin:24px 0 15px 0;
        font-size:17px;
        padding:7px 5px 7px 15px;
        text-align:left;
        color:#b85628;
    }
    .cartWishList i{
        font-size:15px;
        background:#b85628;
        padding:11px 9px 9px 10px;
        border-radius:50px;
        margin:5px;
    }
    .userCart i{
        padding:12px 10px 9px 9px;
    }
    .cartWishList a{
        color:#fff;
    }
    .cartWishList small{
        color:#02040b75;
    }
    .cartWishList .divider{
        background:#02040b35;
        width:1px;
        height:50%;
    }

    #userAddressQrcode{
        margin-top:10px;
        padding:15px;
        box-shadow:0 0 3px 1px #943f1874;
        border-radius:10px;
    }
</style>
</head>
<body>

<!-- Spinner loader -->
<div class="asycRequest">
<div class="bounce1"></div>
<div class="bounce2"></div>
<div class="bounce3"></div>
</div>

    <button style="box-shadow:0 0 2px 1px #cd6332;" class="backBtn historyBack center" title="Back"><i class="fas fa-chevron-left"></i></button>
    
    <div class="userDetails autoscroll" draggable="false">
        
    <?php
    require_once('admin/components/config.php');
    
    if(isset($_SESSION['id']) && strlen($_SESSION['id']) != 0) {

        $currantUser =  mysqli_real_escape_string($con, $_SESSION['id']);
    
        $result = mysqli_query($con,"SELECT id,username,useraddress,reg_date FROM users WHERE id = '$currantUser' LIMIT 1");

        if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {

    ?>
        <img src="./assets/imgs/userAvater.png" alt="User Avater">
        <p class="userName"><?php echo htmlentities($row['username'])?></p>
        <p class="userJoinDate">Join On <?php echo htmlentities($row['reg_date'])?></p>

<div class="cartWishList">
<p class="userCart"><a href="./pages/cart.php"><i class="fas fa-shopping-cart"></i></a> <p><span>Cart</span><br><?php echo $cart->get_cart_count();?> <small><sub>Items</sub></small></p></p>
<p class="divider"></p>

<?php
$query = mysqli_query($con,"SELECT * FROM products WHERE id IN (SELECT productid FROM wishlist WHERE userid ='" . $_SESSION['id'] . "')");

if (mysqli_num_rows($query) > 0) {
?>
<p class="userWishList"><p><span>Wish</span><br><?php echo htmlentities(mysqli_num_rows($query)); ?> <small><sub>Items</sub></small></p> <a href="./pages/wishlist.php"><i class="fas fa-heart"></i></a></p>

<?php } else {?>
<p class="userWishList"><p><span>Wish</span><br>0 <small><sub>Items</sub></small></p> <a href="./pages/wishlist.php"><i class="fas fa-heart"></i></a></p>
<?php }?>

</div>
<p id="userAddressQrcode"></p>
</div>

<!-- js files -->
<script src="./assets/js/autoScroll.js"></script>
<script src="./assets/js/historyBack.js"></script>
<script src="./vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="./assets/js/asycRequest.js"></script>
<script src="./vendor/qrcodejs/qrcode.js"></script>
<script>
    var qrcode = new QRCode(document.getElementById("userAddressQrcode"), {
	width : 150,
	height : 150
});

qrcode.makeCode("<?php echo htmlentities($row['useraddress'])?>");
</script>
<?php }} else { header("location: create-account.php"); exit(); }} else { header("location: login.php"); exit(); }?>
</body>
</html>