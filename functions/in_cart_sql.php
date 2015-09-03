<?php
$query = "SELECT id, name, price FROM products WHERE id IN ({$ids}) ORDER BY name";
        $stmt = $con->prepare( $query );
        $stmt->execute();

?>
