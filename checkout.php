<?php
session_start();
session_destroy();
$page_title="Thank You For Your Order";

include 'header.php';

$customer = $_POST["payer_email"];
$address = $_POST["address_street"];
$post_code = $_POST["address_zip"];
$city = $_POST["address_city"];
$country = $_POST["address_country"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$shipping = $_POST["mc_shipping"];
$tax = $_POST["tax"];
$total = $_POST["mc_gross"];

?>

<p>Print the Order Details for your Records:

<button onclick="printScreen()">Print</button>

</p>
<br />

<script>
function printScreen() {
    window.print();
}
</script>


<?php



if(!isset($_POST["business"]) || $_POST["business"] != "ENTER YOUR PAYPAL EMAIL HERE"){
	
	header('location:http://tafeweb.com/sandbox/Chris_Taylor_08/cart_PAYPAL_current/');
	} else {
	echo'Thank you for your order <span style= color:red;font-weight:bold;>'. $first_name . ' ' . $last_name .'</span>';
	echo '<br />';
    echo'Payment has been received from Paypal.  Your order details are below:';
    echo '<br />';
     echo '<br />';
	}
for($i=1 ; $i <= 9 ; $i++){

        $item = 'item_name'.$i;
        $quantity = 'quantity' .$i;
        $total_item_cost = 'mc_gross_' .$i;

        if(isset($_POST[$item])){

            $product_names = $_POST[$item];
            $product_quantity = $_POST[$quantity];
            $product_total_cost = $_POST[$total_item_cost];

            echo $product_names;
            echo '<br />';
            echo 'Quantity Ordered ' . $product_quantity;
            echo '<br />';
            echo 'Total Product Cost $' . $product_total_cost;
            echo '<br />';
            echo '<br />';
            
         }



   } 

    echo '<br />';
    echo 'Total Shipping Cost $' . $shipping;
     echo '<br />';
    echo 'Total Tax $' . $tax;
    echo '<br />';
    echo '<br />';
    echo '<span style= color:red;font-weight:bold;>Grand Total $' .  $total .'</span>';
    echo '<br />';
    echo '<br />';

    echo 'We will ship your order to the following address:';
    echo '<br />';
    echo '<br />';
    echo $address; 
    echo '<br />';
    echo $city;
    echo '<br />';
    echo $post_code;
    echo '<br />';
    echo $country;
    echo '<br />';
    echo '<br />';
    echo 'Your Previous SESSION data has been destroyed (hence the empty cart.)';
    echo '<br />';
    echo 'The data displayed above comes from POST data from Paypal';
     echo '<br />';
    echo 'This has been a demonstration of linking a third party shopping cart with Paypal as payment gateway.  Thanks for trying it out!!';


                // print out the returned data from PayPal for testing, debugging
                //initial testing!

	    	//echo "<table>";
				//foreach ($_POST as $key => $value) {
	          		//echo "<tr>";
					//echo "<td>";
			       // echo $key;
					//echo "</td>";
			       // echo "<td>";
			       // echo $value;
			       // echo "</td>";
			       // echo "</tr>";
					//}

	      // echo "</table>";


?>
