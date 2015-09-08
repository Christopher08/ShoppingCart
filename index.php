<?php
session_start();

$page_title="Products";
include 'header.php';

//here is a change //


if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == "logged in"){

    echo '<h2>You are logged in <span style="color:red">' . $_SESSION["username"] . '</span>.</h2>';  
    } else {
        echo "<h2>Hi Guest.</h2>  <h3>You must log in to manually save your cart for later</h3>";
        }

    if(isset($_SESSION['username'])){
    
    $time_cookie_name = "EXPIRY_saved_cart" . $_SESSION["username"];

    }

    if(isset($_COOKIE[$time_cookie_name]) && $_COOKIE[$time_cookie_name] != ""){

    echo '<h3>Your saved cart will expire on <span style="color:red">' . $_COOKIE[$time_cookie_name] . '</span></h3>';
    } 


 
// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : "1";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";
$quantity = intval($quantity);

if($action=='added'){
    echo "<div class='alert alert-info'>";
    echo "<strong>{$name}, quantity {$quantity}</strong> was added to your cart!";
    echo "</div>";
}


$query = "SELECT id, name, price FROM products ORDER BY name";
$stmt = $con->prepare( $query );
$stmt->execute();
 
$num = $stmt->rowCount();
 
if($num>0){
 
    //start table
    echo "<br />";
    echo "<table class='table table-hover table-responsive table-bordered'>";
 
        // our table heading
        echo "<tr>";
            echo "<th class='textAlignLeft'>Product Name</th>";
            echo "<th>Price ($)</th>";
            echo "<th>Quantity</th>";
            echo "<th>Action</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
 
            //creating new table row per record
            echo "<tr>";
                echo "<td>";
                    echo "<div class='product-id' style='display:none;'>{$id}</div>";
                    echo "<div class='product-name'>{$name}</div>";
                echo "</td>";
                echo "<td>&#36;{$price}</td>";
                echo '<form action = "index.php" class="add_to_cart" method = "get">';
                echo '<td><input type="number" class="quantity" name="quantity" min="1" max="99" value="1"></td>';
                echo "<td>";
                    echo '<input type="submit" value="Add to cart"><span class="glyphicon glyphicon-shopping-cart"></span>';
                   
                    echo '</form>';
                echo "</td>";
            echo "</tr>";
        }
 
    echo "</table>";
}
 
// tell the user if there's no products in the database
else{
    echo "No products found.";
}
 
include 'footer.php';

?>
