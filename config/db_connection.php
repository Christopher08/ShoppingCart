<?php
//enter your credentials here 
$host = "";
$db_name = "";
$username = "";
$password = "T";

 
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
 
//to handle connection error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
?>
