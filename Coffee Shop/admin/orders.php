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
    ::-webkit-scrollbar{
    width:10px;
    height:10px;
    }
    ::-webkit-scrollbar-thumb{
    border-radius:5px;
    }
    .orderContainer{
        height:calc(100vh - 9.6rem);
        overflow:scroll;
        margin-top:15px;
        font-family:'Gill Sans MT';
    }
    table {
	border-collapse: collapse;    
    text-align:center;
    }
    th, td {
	padding: 5px 10px;
	border: 1px solid #26272d60;
    }
    td{
    font-size:15px;
    }
    th{
    padding:10px;
    font-weight:500;
    background-color: #26272d60;
    }
    td.date{
	white-space: nowrap;
    }
    .link{
    text-decoration:underline;
    color:white;
    }
</style>
</head>
<body>
<!-- header -->
<?php
include_once('./components/header.php');
?>

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
<p class="PageIndicator"><i class="fas fa-shopping-bag"></i></p>
<ul><li><a href="products.php">Products</a> <span>/ Order Details</span></li></ul>
</div>
<div class="orderContainer">
<table class="table table-bordered">
<thead>
	<tr>
		<th class="">S/N</th>
		<th class="">Holder</th>
		<th class="">Order</th>
		<th class="">Quantity</th>
		<th class="">Price</th>
		<th class="">Date</th>
		<th class="">Action</th>
	</tr>
</thead><!-- /thead -->
<tbody>
<?php
// retrieve all ordered products from db
$query = mysqli_query($con,"SELECT users.username AS orderholder, products.productName AS product, products.id AS prodid, users_order.quantity AS qty, users_order.id AS orderid, users_order.userid AS userid, products.productPrice AS price, users_order.orderDate AS orderDate FROM users,products,users_order WHERE products.id=users_order.productid AND users_order.userid=users.id");

if (mysqli_num_rows($query) > 0) {

    $counter = 0;

    while ($row = mysqli_fetch_assoc($query)) {
    
    $counter ++;
?>
<tr>
<td><?php echo $counter; ?></td>
<td><a class="link" href="user-details.php?q=<?php echo htmlentities($row['userid']); ?>"><?php echo htmlentities($row['orderholder']); ?></a></td>
<td><a class="link" href="product-details.php?q=<?php echo htmlentities($row['prodid']); ?>"><?php echo htmlentities($row['product']); ?></a></td>
<td><?php echo htmlentities($row['qty']); ?></td>
<td><?php echo htmlentities(number_format($row['price'])); ?></td>
<td class="date"><?php echo htmlentities($row['orderDate']); ?></td>
<td class="delete"><a class="link" style="color:#c90f05fd;" data-id='<?php echo htmlentities($row['orderid']); ?>'><i class="fas fa-trash-alt"></i></a></td>

</tr>
</tbody>
<?php }}?>
</table>

</div>
</main>

<!-- js files -->
<script src="../assets/js/popUp.js"></script>
<script src="../assets/js/login.js"></script>
<script src="./components/sidebar/sidebar.js"></script>
<script src="../assets/js/autoScroll.js"></script>
<script src="../vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>
<script>
     // iterate over all deleteBtn element
     const deleteBtns = document.querySelectorAll('.delete a');
    for (let deleteBtn of deleteBtns) {
        deleteBtn.onclick = function(){
        let orderid = $(this).data('id');
        $.ajax({
        type: "POST",
		    url: "ajex_validators/delete-order.php",
        data: {
            id: orderid
        },
		success:function(){
      // prevent browser history change
      window.location.href = "orders.php";          
    }
    })
}
}
</script>
</body>
</html>