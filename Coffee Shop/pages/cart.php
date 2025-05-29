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
<title>Coffee Shop | Shopping Cart</title>
<meta name="description" content="Coffee Shop...">
<!-- fav icons -->
<link rel="apple-touch-icon" href="../assets/imgs/favicon/favicon.png">
<link rel="icon" href="../assets/imgs/favicon/favicon.png">
<!-- font awesome icons file -->
<link rel="stylesheet" href="../assets/fonts/fontawesome/all.css">
<!-- css files -->
<link rel="stylesheet" href="../assets/css/app.css">
<link rel="stylesheet" href="../assets/css/itemDetails.css">
<link rel="stylesheet" href="../assets/css/asycRequest.css">
<link rel="stylesheet" href="../assets/css/cart.css">
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
<p class="cartTitle">Cart</p>
<?php
 if(empty($_SESSION['id']) && strlen($_SESSION['id']) == 0) {
    header("location:../login.php");
} else {
if($cart -> get_cart_total() > 0):
?>
<p class="totalOrderList">Order List: <b><span> <?php echo $cart->get_cart_count();?> items</b></span></p>
</div>

<div class="cartList center autoscroll">
    
    <?php $items=$cart->get_all_items(); ?>
    
    <?php foreach($items as $item): ?>

<div class="cart center">
    <div class="detailsHead center">

    <img class="cardImg" src='../admin/uploadedProductsImages/<?php echo $item["img"];?>' width="300" alt="">
    <div class="titlePrice">
        <h2 class="cardTitle"><?php echo $item["name"];?></h2>
        <p class="hutColdCoffee">With <?php echo $item["gradient"];?> <i class="fas fa-mug-hot"></i></p>
        <p class="price"><span>₦</span><?php echo number_format($item["price"]);?></p>

     </div>
    </div>

    <select id="qtyChanger" data-pid='<?php echo $item["id"];?>'>
    <option value="<?php echo $item["qty"];?>"><?php echo $item["qty"];?> +</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    </select>

    <div class="delete center">
    <a data-id='<?php echo $item["id"];?>'><i class="fas fa-trash-alt"></i></a>
</div>
</div>
<?php endforeach; ?>

</div>
<!-- end cartList -->
<div class="checkOut center">
   <p>Total Cost</p> <p class="cashAmoun">₦<?php echo number_format($cart->get_cart_total(), 2);?></p>
   <a href="../pages/checkout.php" class="checkoutBtn center" title="Check Out">Checkout <i class="fas fa-credit-card"></i></a>
</div>
</div>
<?php else: ?>
<div class='emptyCart'><span>Cart</span> is empty!</div>
<?php endif; }?>


<!-- js files -->
<script src="../assets/js/autoScroll.js"></script>
<script src="../assets/js/historyBack.js"></script>
<script src="../vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>
</body>
</html>
<!-- js files -->
<script src="../assets/js/autoScroll.js"></script>
<script src="../assets/js/historyBack.js"></script>
<script src="../vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>
<script>
    // iterate over all select element
    const qtyChangers = document.querySelectorAll('select');
    for (let qtyChanger of qtyChangers) {
        // get its first child
    let fChild = qtyChanger.firstElementChild;
    qtyChanger.onchange = function(){
        fChild.innerHTML = "";
        fChild.innerHTML =  $(this).val();
        let cartid = $(this).data('pid');
        let cartqty = $(this).val();
        $.ajax({
        type: "POST",
		url: "../vendor/php-cart-library/plusQty.php",
        data: {
            qty: cartqty,
            pid: cartid
        },
		success:function(res){
            let q = JSON.parse(res);
			$(".cashAmoun").text(`₦${q.total}`);
        }
    })
    // remove first child (currant Qty)
    this.removeChild(fChild);
	}
}

   // iterate over all deleteBtn element
   const deleteBtns = document.querySelectorAll('.delete a');
    for (let deleteBtn of deleteBtns) {
        deleteBtn.onclick = function(){
        let cartid = $(this).data('id');
        $.ajax({
        type: "POST",
		url: "../vendor/php-cart-library/remove.php",
        data: {
            id: cartid
        },
		success:function(){
            // prevent browser history change
            window.location.href = "cart.php";
        }
    })
}
}
</script>
</body>
</html>