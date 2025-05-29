<?php 
session_start(); 
//Import configuration file
require_once('components/config.php');

if(empty($_SESSION['adminId']) && strlen($_SESSION['adminId']) == 0) {
    header("location:index.php");
} 

// Check if form 'Update' button clicked, and Check if its 'Inputs' are not empty
if(isset($_POST['submit']) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {

$username = mysqli_real_escape_string($con, $_POST["username"]);
$email = mysqli_real_escape_string($con, $_POST["email"]);
$password = mysqli_real_escape_string($con, $_POST["password"]);

$encryptPassword = password_hash($password, PASSWORD_DEFAULT);

$qeury = mysqli_query($con,"UPDATE admin SET username='$username',email='$email',password='$encryptPassword'");

if($qeury) {
// Redirect to login page
header("location: dashboard.php");
exit();
} else {
 echo "<script>alert('Error!');</script>";
}
}
mysqli_close($con);
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
<!-- internal style -->
<style>
main{
    text-align:center;
}
main img{
    margin:25px 0 10px 0;
}
form{
    width:16.5rem;
    margin:0 auto;
}
form button,
form input{
    background-color:#b85628;
    outline:none;
    border:none;
    color:inherit;
    width:16.5em;
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
    width:14.4em;
    height:38px;
    padding:0 15px;
    padding-bottom:2px;
    border:none;
    box-shadow:0 0 4px #b85628c7;
    margin:15px 0;
    cursor:default;
    background-color:#b8562815;
}
form input::placeholder{
    color:#c1c1c1;
    font-size:14px;
}
form input:focus{
    box-shadow:0 0 4px 2px #b85628;
}
form #PassVisibility{
  position:absolute;
  font-size:13px;
  background-color:#b8562818;
  width:48px;
  height:28px;
  line-height:28px;
  margin-top:20px;
  margin-left:-54.5px;
  cursor:pointer;
  border-radius:15px;
  padding-top:2px
}
form .fa-eye-slash{
    color:#c1c1c1;
}
form .fa-eye{
    color:white;
}
form button{
    margin-top:20px;
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
      <li class="products"><i class="fas fa-store-alt"></i>  Products</li>
      </a>
      <a href="update-credantial.php">
      <li class="active"><i class="fas fa-gear"></i>  Setting</li>
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
<p class="PageIndicator"><i class="fas fa-gear"></i></p>
<ul><li><a href="dashboard.php">Dashboard</a> <span>/ Setting</span></li></ul>
</div>

<img src="./assets/imgs/admin.jpg" width="100" alt="Admin Avatar">
<form action="#" method="post" novalidate>
        <div class="inputs">
        <input type="text" name="username" maxlength="25" placeholder="Enter UserName"><br>
        <input type="email" name="email" id="email" maxlength="40" placeholder="Enter E-Mail"><br>
        <input type="password" name="password" maxlength="10" placeholder="Enter Password"><i title="See Password" id="PassVisibility" class="fas togglePassVisibility fa-eye-slash"></i>
        </div>
        <button type="submit" name="submit" title="Update">Update</button>
    </form>
</main>
</div>

<!-- js files -->
<script src="./components/sidebar/sidebar.js"></script>
<script src="../assets/js/popUp.js"></script>
<script src="../assets/js/login.js"></script>
<script src="../vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>
</body>
</html>
