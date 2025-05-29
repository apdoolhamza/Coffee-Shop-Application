<?php 
session_start(); 
require_once('../components/config.php');

// Check if form 'login' button exist, and Check if its 'Inputs' are not empty
if(isset($_POST['login']) || !empty($_POST["useremail"]) && !empty($_POST["password"])) {

	$email = mysqli_real_escape_string($con, $_POST["useremail"]);
	$password = mysqli_real_escape_string($con, $_POST["password"]);

	$result = mysqli_query($con,"SELECT * FROM admin WHERE email = '$email' LIMIT 1");

	$row = mysqli_fetch_assoc($result);
	if($row > 0) {
	if(password_verify($password, $row['password'])) {

	// store admin 'id' in SESSION
	$_SESSION['adminId'] = $row['id'];

    // Redirect to the dashboard page
	 echo "dashboard.php"; 
	} else {
		echo "<h3 style='color:black;margin-bottom:-10px;font-size:15px;'>Error</h3><br>User not found!";
	}
	} else {
	echo "<h3 style='color:black;margin-bottom:-10px;font-size:15px;'>Error</h3><br>User not found!";
	}
}
mysqli_close($con);
?>
