<?php
session_start();
include 'functions/saved_cart_cookie_function.php';
 
// get the product id
$id = isset($_GET['id']) ? $_GET['id'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";
 
$_SESSION['cart_items'][$id]=array(
    		"name" => $name,
    		"quantity" => intval($quantity)
			);
 
 	savedCart();
 
 
 header('Location: cart.php?action=quantity_updated&id' . $id . '&name=' . $name . '&quantity=' . $quantity);

?>
