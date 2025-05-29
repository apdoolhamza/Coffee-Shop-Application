<?php 
session_start(); 
//Import configuration file
require_once('components/config.php');

if(empty($_SESSION['adminId']) && strlen($_SESSION['adminId']) == 0) {
    header("location:index.php");
} 

if(isset($_POST['update']) || !empty($_POST["coffeeimg"]) && !empty($_POST["coffeename"]) && !empty($_POST["coffeeprice"]) && !empty($_POST["coffeegradient"]) && !empty($_POST["coffeedesc"])) {

    $coffeeimg = $_FILES['coffeeimg']['name'];
    $imgtempname = $_FILES['coffeeimg']['tmp_name'];
    $coffeename = mysqli_real_escape_string($con, $_POST['coffeename']);
    $coffeeprice = mysqli_real_escape_string($con, $_POST['coffeeprice']);
    $coffeegradient = mysqli_real_escape_string($con, $_POST['coffeegradient']);
    $coffeedescription = mysqli_real_escape_string($con, $_POST['coffeedesc']);

    $imgsfolder = "uploadedProductsImages/" . $coffeeimg;

    if (isset($_GET['q'])) {
     $id = $_GET['q'];

    $qeury = mysqli_query($con,"UPDATE products SET productImage='$coffeeimg',productName='$coffeename',productPrice='$coffeeprice',productGradient='$coffeegradient',productDescription='$coffeedescription' WHERE id='$id'");

if($qeury) {
   move_uploaded_file($imgtempname, $imgsfolder);
   header("location:products.php");
   exit();
exit();
} else {
    echo "<script>alert('Error!, Something Is Wrong');</script>";
}
}
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
    main{
    text-align:center;
}
    .form{
        width:16.5rem;
        margin:0 auto;
        margin-top:20px;
        height:calc(100% - 5rem);
        overflow:scroll;
    }
   form img{
        width:120px;
        height:120px;
        border-radius:10px;
        border:2px solid transparent;
        box-shadow:0 0 2px 1px #b85628;
        margin:5px 0 10px 0;
        background:silver;
    }
form button,
form input{
    background-color:#b85628;
    outline:none;
    border:none;
    color:inherit;
    width:15em;
    height:44px;
    border-radius:25px;
    cursor:pointer;
    font-size:16px;
    font-family: inherit;
}
form div{
font-family:monospace;
letter-spacing:-1px;
}
form input{
    width:13em;
    height:35px;
    padding:0 15px;
    padding-bottom:2px;
    border:none;
    box-shadow:0 0 4px #b85628c7;
    margin:12px 0;
    cursor:default;
    background-color:#b8562815;
}
form textarea{
    padding:10px;
    box-shadow:0 0 4px #b85628c7;
    background-color:#b8562815;
    border:none;
    outline:none;
    border-radius:5px;
    margin-top:12px;
    color:inherit;
    resize:none;
}
form input::placeholder,
form textarea::placeholder{
    color:#c1c1c1;
    font-size:14px;
}
form input:focus,
form textarea:focus{
    box-shadow:0 0 3px 1px #b85628;
    transition:all .3s;
}
form button{
    margin-top:20px;
}
form button i{
    margin-left:4px;
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
<p class="PageIndicator"><i class="fas fa-cart-flatbed"></i></p>
<ul><li><a href="products.php">Products</a> <span>/ Product Details</span></li></ul>
</div>

<?php 
 if (isset($_GET['q'])) {
  $id = $_GET['q'];

$result = mysqli_query($con, "SELECT * FROM products WHERE id='$id'");

$item = mysqli_fetch_assoc($result);
?>
<div class="form autoscroll">
<form method="post" enctype="multipart/form-data" novalidate>
<label for="coffeeImg">
<img title="Upload Coffee Image" src="uploadedProductsImages/<?php echo htmlentities($item['productImage']); ?>" alt="Coffee Image" id="imgReview">
<input type="file" name="coffeeimg" value="<?php echo htmlentities($item['productImage']); ?>" id="coffeeImg" onchange="loadImg(event);" hidden required>
</label>
<input type="text" spellcheck="false" value="<?php echo htmlentities($item['productName']); ?>" name="coffeename" id="coffeename" placeholder="Coffee Name" maxlength="13">
<input type="text" name="coffeeprice" value="<?php echo htmlentities(number_format($item['productPrice'])); ?>" id="coffeeprice" maxlength="5" autocomplete="off"  placeholder="Price eg. 700, 2.5k ..." required>
<input type="text" spellcheck="false" name="coffeegradient" value="<?php echo htmlentities($item['productGradient']); ?>" id="coffeegradient" maxlength="13" placeholder="eg. Oat Milk, Suger ..." required>
<textarea name="coffeedesc" value="<?php echo htmlentities($item['productDescription']); ?>" cols="28" rows="5" placeholder="Coffee Description..." required><?php echo htmlentities($item['productDescription']); ?></textarea>

<button type="submit" name="update">Update</i></button>
</form>
</div>
<?php } else { header('location:products.php'); }?>
</main>
</div>

<!-- js files -->
<script src="../assets/js/popUp.js"></script>
<script src="../assets/js/login.js"></script>
<script src="./components/sidebar/sidebar.js"></script>
<script src="../assets/js/autoScroll.js"></script>
<script src="../vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>

<script>
    // preview selected product image
    function loadImg(event){
        let img = document.getElementById('imgReview');
        img.src = URL.createObjectURL(event.target.files[0]);
    }

// Remove price-field non-numeric characters
coffeeprice.addEventListener('input', () => {
    let nums = coffeeprice.value.replace(/\D/g, "");
    coffeeprice.value = nums;
})
</script>
</body>
</html>