<?php 
session_start(); 
//Import configuration file
require_once('admin/components/config.php');

// Check if form 'Create Accout' button clicked, and Check if its 'Inputs' are not empty
if(isset($_POST['submit']) || !empty($_POST["username"]) && !empty($_POST["useraddress"]) && !empty($_POST["userphone"]) && !empty($_POST["userpassword"]) && strlen($_POST["userphone"])==11) {

	$username = mysqli_real_escape_string($con, $_POST["username"]);
	$useraddress = mysqli_real_escape_string($con, $_POST["useraddress"]);
	$userphone = mysqli_real_escape_string($con, $_POST["userphone"]);
	$userpassword = mysqli_real_escape_string($con, $_POST["userpassword"]);

    $encryptPassword = password_hash($userpassword, PASSWORD_DEFAULT);

$result = mysqli_query($con,"SELECT id FROM users WHERE userphone = '$userphone'");
$row = mysqli_num_rows($result);

if(!$row > 0) {
$qeury = mysqli_query($con,"INSERT INTO users(username,useraddress,userphone,userpassword) VALUES('$username','$useraddress','$userphone','$encryptPassword')");

if($qeury) {

// Redirect the user to login page
header("location: login.php");
exit();
}
}
}
mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coffee Shop | Create New User Account</title>
<meta name="description" content="Coffee Shop...">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- fav icon -->
<link rel="apple-touch-icon" href="./assets/imgs/favicon/favicon.png">
<link rel="icon" href="./assets/imgs/favicon/favicon.png">
<!-- font awesome icons file -->
<link rel="stylesheet" href="./assets/fonts/fontawesome/all.css">
<!-- css files -->
<link rel="stylesheet" href="./assets/css/asycRequest.css">
<link rel="stylesheet" href="./assets/css/login.css">
<link rel="stylesheet" href="./assets/css/popUp.css">
</head>
<body>
<!-- Spinner loader -->
<div class="asycRequest">
<div class="bounce1"></div>
<div class="bounce2"></div>
<div class="bounce3"></div>
</div>

<main>
<img src="./assets/imgs/logo.png" width="150" alt="logo.png">
<form method="post" novalidate>
        <div class="title">
        <h3 style="margin-bottom:-5px;">Create <span>Account</span></h3>
        </div>
        <div class="inputs">
        <input type="text" name="username" maxlength="25" placeholder="Enter Username"><br>
        <input type="text" name="useraddress" maxlength="100" placeholder="Enter Address"><br>
        <input type="tel" name="userphone" maxlength="11" id="userphone" onkeyup="return checkPhoneAvailability();" placeholder="Phone Number"><br>
        <input type="password" name="userpassword" maxlength="10" placeholder="Enter Password"><i title="See Password" id="PassVisibility" class="fas togglePassVisibility fa-eye-slash"></i>
        <a class="forgotPass" href="forgot-password.php" title="Forgot Password?">Forgot password?</a>
        </div>
        <button type="submit" title="Create Account" name="submit">Create Account</button>
        <p style="margin-top:15px;" class="haveanAccount center">Already have an account? <a href="login.php" title="Sign In now!">Sign In</a></p>
    </form>
    </main>

<!-- js files -->
<script src="./assets/js/popUp.js"></script>
<script src="./assets/js/login.js"></script>
<script src="./vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="./assets/js/asycRequest.js"></script>
<script>
// ajex, check if phone number already exist by some user in "users" db, live
 function checkPhoneAvailability() {
jQuery.ajax({
url: "ajex_validators/check-userphone-availability.php",
data:'userphone=' + $("#userphone").val(),
type: "POST",
success: function(response){
    if (userphone.value.length >= 11) {
    popUp('',response);
    } else {
    closePopUp();
    }
},
error: function (){}
});
}

// Remove phone-field non-numeric characters
userphone.addEventListener('input', () => {
    let nums = userphone.value.replace(/\D/g, "");
    userphone.value = nums;
})

// chech phone field length
const Inputs = document.querySelectorAll('form input');
document.querySelector('form').addEventListener('submit', (e) => {
    for (let input of Inputs) {
    if (input.value !== "") {
    if (userphone.value.length >= 1 && userphone.value.length <= 10) {
        popUp('Error','Phone should be (11) digits!');
        e.preventDefault();
    }
}
}
})
</script>
</body>
</html>