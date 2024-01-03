<?php

function fetchProductsFromDatabase() {
    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $dbname = 'sns';
    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $products = array();

    $query = "SELECT * FROM product_tbl";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    $conn->close();

    return $products;
}

?>
