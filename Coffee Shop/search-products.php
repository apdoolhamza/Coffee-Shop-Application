<?php 
//Import configuration file
require_once('admin/components/config.php');

if(isset($_POST['query'])) {

	$search = mysqli_real_escape_string($con, $_POST["query"]);

    $query = "SELECT id,productImage,productName,productGradient,productPrice FROM products WHERE productName LIKE '%$search%'";
} else {
    $query = "SELECT id,productImage,productName,productGradient,productPrice FROM products";
}

$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {

while ($row = mysqli_fetch_array($result)) {
echo "<div class='card center'><p class='reviews'><i class='fas fa-star'></i> <span>0.0</span></p><div class='cardImgContainer'><img class='cardImg' src='./admin/uploadedProductsImages/" . htmlentities($row['productImage']) . "' alt='Coffee Image'></div><h2 class='cardTitle'>" . htmlentities($row['productName']) . "</h2><p class='cardDesc'>With " . htmlentities($row['productGradient']) . "</p><div class='priceCartcontainer center'><p class='price'><span>₦</span>" . htmlentities(number_format($row['productPrice'])) . "</p><a href='./pages/itemDetails.php?q=" . htmlentities($row['id']) ."'class='addToCartBtn'><i class='fas fa-circle-plus'></i></a></div></div>";
} 

} else {
        echo '<p class="itemNotFound"><span>Coffee</span> not found!</p>';
}
mysqli_close($con);
?>
