<?php 
session_start(); 
require_once('../admin/components/config.php');

// Check if form 'changepassword' button clicked, and Check if its 'Inputs' are not empty
if(isset($_POST['changepassword']) || !empty($_POST["userphone"]) && !empty($_POST["userpassword"]) && strlen($_POST["userphone"])==11) {

	$userphone = mysqli_real_escape_string($con, $_POST["userphone"]);
	$userpassword = mysqli_real_escape_string($con, $_POST["userpassword"]);

	// chech if user phone number exist
	$result = mysqli_query($con,"SELECT userphone FROM users WHERE userphone = '$userphone' LIMIT 1");

	if (mysqli_num_rows($result) > 0) {

	// ecryp the user password
	$encryptPassword = password_hash($userpassword, PASSWORD_DEFAULT);

	// update user password
	$query = mysqli_query($con, "UPDATE users SET userpassword='$encryptPassword' WHERE userphone='$userphone'");

	if($query) {
	echo "login.php";
	} else {
	echo "<h3 style='color:black;margin-bottom:-10px;font-size:15px;'>Error</h3><br>Fail to Update!";
	}
} else {
	echo "<h3 style='color:black;margin-bottom:-10px;font-size:15px;'>Error</h3><br>Phone number not found!";
}
}
mysqli_close($con);
?>
