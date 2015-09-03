<?php
	
	function savedCart(){
	
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == "logged in"){
		
		$cookie_name = "saved_cart" . $_SESSION["username"];
		$cookie_value = json_encode($_SESSION["cart_items"]);
		$cookie_time = time() + (86400 * 10);
		
		setcookie($cookie_name, $cookie_value, $cookie_time, "/", false); // 86400 = 1 day
		
		
		$time_cookie_name = "EXPIRY_saved_cart" . $_SESSION["username"];
        $time_cookie = time() + (86400 * 10);
        $time_cookie_value = date("Y-m-d", $time_cookie);

        setcookie($time_cookie_name, $time_cookie_value, time() + (86400 * 10), "/", false);




		}  // final argument set as false for cookie to work on MAMP local host
	
	}


	



?>
