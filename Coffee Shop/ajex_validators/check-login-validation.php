<?php 
session_start(); 
require_once('../admin/components/config.php');

// Check if form 'login' button exist, and Check if its 'Inputs' are not empty
if(isset($_POST['login']) || !empty($_POST["userphone"]) && !empty($_POST["userpassword"]) && strlen($_POST["userphone"])==11) {

	$userphone = mysqli_real_escape_string($con, $_POST["userphone"]);
	$userpassword = mysqli_real_escape_string($con, $_POST["userpassword"]);

	$result = mysqli_query($con,"SELECT id,userphone,userpassword FROM users WHERE userphone = '$userphone' LIMIT 1");

	$row = mysqli_fetch_assoc($result);
	if($row > 0) {
	if(password_verify($userpassword, $row['userpassword'])) {

	// store user 'id' in SESSION
	$_SESSION['id'] = $row['id'];

    // Redirect the user to the Home page
	 echo "index.php"; 
	} else {
		echo "<h3 style='color:black;margin-bottom:-10px;font-size:15px;'>Error</h3><br>User not found!";
	}
	} else {
	echo "<h3 style='color:black;margin-bottom:-10px;font-size:15px;'>Error</h3><br>User not found!";
	}
}
mysqli_close($con);
?>
