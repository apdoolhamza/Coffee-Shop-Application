<?php 
 session_start();
 // import configuration file
 require_once('../components/config.php');

  $id = $_POST["id"];
  
  $result = mysqli_query($con, "DELETE FROM products WHERE id='$id'");
?>