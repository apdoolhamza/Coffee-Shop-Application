<?php 
  session_start();

  include "cart.class.php";

  $id=$_POST["id"];
  
  $cart=new Cart();
  $cart->remove($id);
?>