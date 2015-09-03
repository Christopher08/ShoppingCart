<?php
// resume or start a new session
session_start();


//Check for login form data
if(isset($_POST['username'])){

		include 'functions/log_in_function.php';
		userLogIn();

		}

$page_title="Log In";
include 'header.php';

if(isset($_POST['new_username'])){

	$errors = array();
	
	if (empty($_POST['new_username'])){
		$errors[] = "You did not enter a username!";
	} else {
		$new_username = $_POST['new_username'];
		}
	
	if($_POST['new_password'] != $_POST['confirm_password']){
		$errors[] = "Your passwords do not match!";
	} else if(empty($_POST['new_password'])){
		$errors[] = "You did not enter a password!";
		} 
		else
			{
			$new_password = md5($_POST['new_password']);
			}

	if (empty($_POST['first_name'])){
		$errors[] = "You did not enter a first name!";
	} else {
		$first_name = $_POST['first_name'];
		}	

	if (empty($_POST['last_name'])){
		$errors[] = "You did not enter a lastname!";
	} else {
		$last_name = $_POST['last_name'];
		}	
if (empty($_POST['email'])){
		$errors[] = "You did not enter an email!";
	} else {
		$email = $_POST['email'];
		}	

	if (empty($_POST['address'])){
		$errors[] = "You did not enter an address!";
	} else {
		$address = $_POST['address'];
		}	

	if (empty($_POST['phone'])){
		$errors[] = "You did not enter a mobile number!";
	} else {
		$phone = $_POST['phone'];
		}	
	
	if(empty($errors)){
	

	$db_connection = mysqli_connect("localhost", "root", "","shopping_cart");

		if(mysqli_connect_errno($db_connection)){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

	
	$sql_query = "INSERT INTO admin SET 
	username = '$new_username',
	password = '$new_password',
	email 	 =  '$email',
	address = '$address',
	phone = '$phone',
	first_name = '$first_name',
	last_name = '$last_name'";

	$db_insert = mysqli_query($db_connection, $sql_query);

	if($db_insert){
		echo '<p>Thank you!  You are now registered!  Please <a href="login.php"> Log in </a>to continue shopping.</p>';
		
	} else {
		echo '<p>Error adding new user: '. mysql_error() . '</p>';
		}
	exit();

} else {
	echo '<div>';
	echo '<p style= "font-weight: bold;"><span style="text-decoration:underline;">The following errors occured:</span><br />';
	foreach($errors as $msg){
		echo "$msg<br />\n";
	}
	echo "Please try again</p>";
	echo '</div>';
	
	}

}
?>
<h2>Log in</h2>
<br />
<form action="" method="POST">
	<p><label for="username">Username: <input type="text" name="username" /></label></p>
    <p><label for="password">Password: <input type="password" name="password" /></label></p>
    <p><input type="submit" value="LOG IN"/></p>
</form>

<br />

<h2>Register</h2>
<form action ="" method = "POST">
Username:<br />
<input type="text" name="new_username">
<br />
Password:<br />
<input type="text" name="new_password">
<br />
Confirm Password:<br />
<input type="text" name="confirm_password">
<br />
First name:<br />
<input type="text" name="first_name">
<br />
Last name:<br />
<input type="text" name="last_name">
<br />
Email:<br />
<input type="email" name="email">
<br />
Address:<br />
<textarea rows="4" cols="50" name="address">
</textarea>
<br />
Mobile number:<br />
<input type="text" name="phone">
<br />
<br />
<p><input type="submit" value="SIGN UP"/></p>
</form>
<br />



<?php
include 'footer.php';

?>
