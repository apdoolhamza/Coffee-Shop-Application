<?php 
session_start(); 
require_once('../components/config.php');

// Check if form 'change password' button clicked, and Check if its 'Inputs' are not empty
if(isset($_POST['submit']) || !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {

	$username = mysqli_real_escape_string($con, $_POST["username"]);
	$email = mysqli_real_escape_string($con, $_POST["email"]);
	$password = mysqli_real_escape_string($con, $_POST["password"]);

	// chech if username & email exist
	$result = mysqli_query($con,"SELECT username,email FROM admin WHERE username='$username' AND email='$email'");

	if (mysqli_num_rows($result) > 0) {

	// ecryp the password
	$encryptPassword = password_hash($password, PASSWORD_DEFAULT);

	// update password
	$query = mysqli_query($con, "UPDATE admin SET password='$encryptPassword' WHERE username='$username' AND email='$email'");

	if($query) {
	echo "index.php";
	} else {
	echo "<h3 style='color:black;margin-bottom:-10px;font-size:15px;'>Error</h3><br>Fail to Update!";
	}
} else {
	echo "<h3 style='color:black;margin-bottom:-10px;font-size:15px;'>Error</h3><br>Details not found!";
}
}
mysqli_close($con);
?>
