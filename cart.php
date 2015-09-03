<?php session_start();

$page_title="Cart";
include 'header.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";
$action = isset($_GET['action']) ? $_GET['action'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";

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





if($action=='removed'){
    echo "<div class='alert alert-info'>";
        echo "<strong>{$name}</strong> was removed from your cart!";
    echo "</div>";
}
 
else if($action=='quantity_updated'){
    echo "<div class='alert alert-info'>";
        echo "<strong>{$name}</strong> quantity was updated!";
    echo "</div>";
}

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == "logged in"){
    
    $cookie_name = "saved_cart" . $_SESSION["username"];
    $_SESSION['cart_items'] = json_decode($_COOKIE[$cookie_name], true);
}
if(count($_SESSION['cart_items'])>0){

    
    $ids = "";
    $quantity = "";
   
    foreach($_SESSION['cart_items'] as $id=>$value){
        $ids = $ids . $id . ",";

        
    }

    // remove the last comma
    $ids = rtrim($ids, ',');
    
    
    //start table
    echo "<table class='table table-hover table-responsive table-bordered'>";
 
        // our table heading
        echo "<tr>";
            echo "<th class='textAlignLeft'>Product Name</th>";
            echo "<th>Price ($)</th>";
            echo "<th>Quantity</th>";
            echo "<th>Total</th>";
            echo "<th>Update Quantity</th>";
            echo "<th>Action</th>";
        echo "</tr>";

        
        require('functions/in_cart_sql.php');
        
        
        $total_price=0;
        $total_items=0;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $quantity = $_SESSION['cart_items'][$id]['quantity'];
        

            $quantity = intval($quantity);
            $total = $quantity * $price; 

        
            echo "<tr>";
                echo "<div style='display:none;'>{$id}</div>";
                echo "<td><div class='product-name'>{$name}</div></td>";
                 echo "<td>&#36;{$price}</td>";
                echo "<td>{$quantity}</td>";
                echo "<td>&#36;$total</td>";
                echo '<form name="update_quantity" class="update_quantity" method="get" action="cart.php">';
                echo '<input type="hidden" class="product-id" value=' . $id . '>';
                echo '<input type="hidden" class="product-name" value=' . $name .'>';
                echo '<td><input type="number" class="update-quantity" name="update_quantity" min="1" max="99"></td>';
                echo '<td><input type="submit" name="submit" value="Update Cart"></td>';
                echo '</form>';
                echo "<td>";
                    echo "<a href='remove_from_cart.php?id={$id}&name={$name}' class='btn btn-danger'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Remove all from cart";
                    echo "</a>";
                echo "</td>";
            echo "</tr>";
 
            $total_price += $total;
            $total_items += $quantity; 
            $expiry = time() + (86400 * 2);
            $promo_warning = date("Y-m-d", $expiry);
        }

 echo '<tr style="background-color:#012169";><td style="background-color:#012169"></td><td style="background-color:#012169"></td><td style="background-color:#012169"><td style="background-color:#012169"></td><td style="background-color:#012169"></td><td style="background-color:#012169"></td><td style="background-color:#012169"></td></tr>';
        echo "<tr>";
        
                echo "<td><b>Total Items:</b></td>";
                echo "<td>{$total_items}</td>";
                echo "<td><b>Total Cost:</b></td>";
                echo "<td>&#36;{$total_price}</td>";
                echo "<td></td>";
                
                echo "<td>";
                    echo '<form name="checkout" method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr" class="btn btn-success">';


                    echo '<input type="hidden" name="cmd" value="_cart">';
                    echo '<input type="hidden" name="upload" value="1">';
                    echo '<input type="hidden" name="business" value="christophertaylor0811-facilitator@gmail.com">';   
                    echo '<input type="hidden" name="rm" value="2">';
                    echo '<input type="hidden" name="return" value="http://tafeweb.com/sandbox/Chris_Taylor_08/cart_PAYPAL_current/checkout.php">';
                    //echo '<input type="hidden" name="return" value="http://localhost:8080/cart_PAYPAL_current/checkout.php">';
        
        require('functions/in_cart_sql.php');
        
        



        $paypalCount = 1;
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $quantity = $_SESSION['cart_items'][$id]['quantity'];

        

                    echo '<input type="hidden" name="item_name_'.$paypalCount.'" value="'. $name .'">';
                    echo '<input type="hidden" name="amount_'.$paypalCount.'" value="'. $price .'">';
                    echo '<input type="hidden" name="quantity_'.$paypalCount.'" value="' . $quantity .'">';
        
                    $paypalCount++;
        }


                    
                    echo '<span class="glyphicon glyphicon-shopping-cart"></span><input type="submit" class="btn btn-success" name="checkout" value="Checkout">';
                    echo '</form>';
                    echo "</td>";
                    echo "<td>";
                    echo "</td>";
            echo "</tr>";
 
    echo "</table>";
}
 
else{

    echo "<div class='alert alert-danger'>";
        echo "<strong>No products found</strong> in your cart!";
    echo "</div>";
} 
 
include 'footer.php';

?>
