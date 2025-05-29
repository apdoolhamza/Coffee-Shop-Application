<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coffee Shop | Admin Login</title>
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
<style>
form button[type="submit"]{
    margin:45px 0 20px 0;
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

    <main>
    <img src="../assets/imgs/logo.png" width="250" alt="logo.png">
    <form action="signin.php" method="post" novalidate onsubmit="return checkValidation();">
        <div class="title">
        <h3>Welcome <span>Back</span></h3>
        </div>
        <div class="inputs">
        <input type="email" name="useremail" id="useremail" placeholder="E-Mail" maxlength="40"><br>
        <input type="password" name="password" id="password"  maxlength="10" placeholder="Password"><i id="PassVisibility" class="fas togglePassVisibility fa-eye-slash"></i>
        <a class="forgotPass" href="forgot-password.php" title="Forgot Password?">Forgot password?</a>
        </div>
        <button type="submit" name="login" title="Log In">Login</button>
    </form>
    </main>

<!-- js files -->
<script src="../assets/js/popUp.js"></script>
<script src="../assets/js/login.js"></script>
<script src="../vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="../assets/js/asycRequest.js"></script>
<script>
// check admin validation Live
function checkValidation() {
event.preventDefault();

jQuery.ajax({
url: "ajex_validators/check-login-validation.php",
data:'useremail=' + $("#useremail").val() + '& password=' + $("#password").val(),
method: "POST",
success: function(response){
    let match = /User not found!/igm;
    if (match.test(response)) {
        popUp('',response);
    } else {
    window.location.href = response;
    }
},
error: function (){}
});
}

</script>
</body>
</html>