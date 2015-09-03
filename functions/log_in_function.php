<?php

function userLogIn(){

		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$db_connection = mysqli_connect("localhost", "YOUR DB", "YOUR USERNAME" ,"YOUR PASSWORD");

		if(mysqli_connect_errno($db_connection)){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$sql_query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";

		$db_result = mysqli_query($db_connection, $sql_query);

		$row=mysqli_fetch_array($db_result,MYSQLI_ASSOC);
		
		$first_name = $row["first_name"];
		$last_name  = $row["last_name"];
		$email  = $row["email"];	
		$phone  = $row["phone"];
		$address  = $row["address"];
		$username = $row["username"];

		
		
		if(mysqli_num_rows($db_result)){
			$_SESSION['logged_in'] = "logged in";
			$_SESSION['username'] = $username;
			$_SESSION['first_name'] = $first_name;
			$_SESSION['last_name'] = $last_name;
			$_SESSION['email'] = $email;
			$_SESSION['phone'] = $phone;
			$_SESSION['address'] = $address;
			
			header ("Location: cart.php");
		
			} else {
				
				echo '<div>';
				echo '<p style= "font-weight: bold;text-align:center;"><span style="text-decoration:underline;">--INCORRECT USERNAME & PASSWORD COMBINATION, YOU MUST LOG IN TO SAVE YOUR CART--</span><br />';
				echo '</div>';
				
				}
