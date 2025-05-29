<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coffee Shop | User Login</title>
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
    <img src="./assets/imgs/logo.png" width="250" alt="logo.png">
    
    <form method="post" novalidate>
        <div class="title">
        <h3>Login to <span>Shop</span></h3>
        </div>
        <div class="inputs">
        <input type="tel" name="userphone" maxlength="11" id="userphone" placeholder="Enter Phone" required><br>
        <input type="password" name="userpassword" id="userpassword" maxlength="10" placeholder="Enter Password" required><i id="PassVisibility" class="fas togglePassVisibility fa-eye-slash"></i>
        <a class="forgotPass" href="forgot-password.php" title="Forgot Password?">Forgot password?</a>
        </div>
        <button type="submit" title="Log In" name="login">Login</button>
        <p class="haveanAccount center">Don't have an account? <a href="create-account.php" title="Sign Up now!">Sign Up</a></p>
    </form>
    </main>

<!-- js files -->
<script src="./assets/js/popUp.js"></script>
<script src="./assets/js/login.js"></script>
<script src="./vendor/jquery/jquery-3.6.4.min.js"></script>
<script src="./assets/js/asycRequest.js"></script>
<script>
// check user validation Live
function checkValidation() {
jQuery.ajax({
url: "ajex_validators/check-login-validation.php",
data:'userphone=' + $("#userphone").val() + '& userpassword=' + $("#userpassword").val(),
method: "POST",
success: function(response){
if (userphone.value.length >= 11 && userpassword.value !== "") {
    let match = /User not found!/igm;
    if (match.test(response)) {
        popUp('',response);
    } else {
    window.location.href = response;
    }
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
    e.preventDefault();
    for (let input of Inputs) {
    if (input.value !== "") {
    if (userphone.value.length >= 1 && userphone.value.length <= 10) {
    popUp('Error','Phone should be (11) digits!');
    e.preventDefault();
    }
}
}
// call validation function if user try to submit the form
checkValidation();
})
</script>
</body>
</html>