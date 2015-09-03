<?php
session_start();
include 'functions/saved_cart_cookie_function.php';
// get the product id
$id = isset($_GET['id']) ? $_GET['id'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";
 
/*
 * check if the 'cart' session array was created
 * if it is NOT, create the 'cart' session array
 */

if(!isset($_SESSION['cart_items'])){	
    $_SESSION['cart_items'][$id] = array(
    		"name" => $name,
    		"quantity" => intval($quantity)
			);

 	}
// else, add the item to the array: 
 else{
    $_SESSION['cart_items'][$id]=array(
    		"name" => $name,
    		"quantity" => intval($quantity)
            );

    }

	savedCart();
    //$cookie_time = time() + (86400 * 10);
   // $cookie_date = date("Y-m-d", $cookie_time);
    //$_SESSION['time'] = $cookie_date;
   
    
 
 header('Location: index.php?action=added&id' . $id . '&name=' . $name . '&quantity=' . $quantity);

 
   
   
?>


