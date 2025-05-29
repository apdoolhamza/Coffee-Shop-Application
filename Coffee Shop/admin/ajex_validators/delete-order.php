<?php 
 session_start();
 // import configuration file
 require_once('../components/config.php');

  $id = $_POST["id"];
  
  $result = mysqli_query($con, "DELETE FROM users_order WHERE id='$id'");
?>