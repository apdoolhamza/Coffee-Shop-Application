<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coffee Shop | Change Admin Password</title>
<meta name="description" content="Coffee Shop...">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- fav icon -->
<link rel="apple-touch-icon" href="../assets/imgs/favicon/favicon.png">
<link rel="icon" href="../assets/imgs/favicon/favicon.png">
<!-- font awesome icons file -->
<link rel="stylesheet" href="../assets/fonts/fontawesome/all.css">
<!-- css files -->
<link rel="stylesheet" href="../assets/css/asycRequest.css">
<link rel="stylesheet" href="../assets/css/login.css">
<link rel="stylesheet" href="../assets/css/popUp.css">
</head>
<body>
<!-- Spinner loader -->
<div class="asycRequest">
<div class="bounce1"></div>
<div class="bounce2"></div>
<div class="bounce3"></div>
</div>

<main>
<img src="../assets/imgs/logo.png" width="250" alt="logo.png">
<form method="post" novalidate onsubmit="return checkValidation();">
        <div class="title">
        <h3>Change <span>Password</span></h3>
        </div>
        <div class="inputs">
        <input type="text" name="username" id="username" maxlength="25" placeholder="Enter UserName"><br>
        <input type="email" name="email" id="email" maxlength="40" placeholder="Enter E-Mail"><br>
        <input type="password" name="password" id="password" maxlength="10" placeholder="New Password"><i title="See Password" id="PassVisibility" class="fas togglePassVisibility fa-eye-slash"></i>
        </div>
        <button type="submit" name="submit" title="Create Account">Change Password</button>
        <p class="haveanAccount center">Already have a password? <a href="index.php" title="Sign In now!">Sign In</a></p>
    </form>
    </main>

<!-- js files -->
<script src="../assets/js/popUp.js"></script>
<script src="../assets/js/login.js"></script>
<script src="../vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>
<script>

function checkValidation() {
event.preventDefault();

jQuery.ajax({
url: "ajex_validators/check-forgot-validation.php",
data:'username=' + $("#username").val() + '& email=' + $("#email").val() + '& password=' + $("#password").val(),
method: "POST",
success: function(response){
    let match = /index.php/igm;
    if (match.test(response)) {
        window.location.href = response;
    } else {
        popUp('',response);
    }
},
error: function (){}
});
}
</script>
</body>
</html>