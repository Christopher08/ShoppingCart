<?php
session_start();
include 'functions/saved_cart_cookie_function.php';
 
// get the product id
$id = isset($_GET['id']) ? $_GET['id'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
 
// remove the item from the array
unset($_SESSION['cart_items'][$id]);

savedCart();
 
// redirect to product list and tell the user it was added to cart
header('Location: cart.php?action=removed&id=' . $id . '&name=' . $name);
?>
