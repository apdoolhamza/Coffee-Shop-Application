<?php
//Import php cart library file
require_once('./cart.class.php');
$cart = new Cart();

  $id = $_POST['pid'];
  $qty = $_POST['qty'];
  
  $cart->update_cart(["id"=>$id,"qty"=>$qty]);
  
  $result=[
    	"qty" => $cart->get_item($id)["qty"],
    	"total" => number_format($cart->get_cart_total(), 2),
      ];
    echo json_encode($result);
?>