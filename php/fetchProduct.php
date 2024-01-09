<?php

function fetchProductsFromDatabase() {
    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $dbname = 'db_shopnswap';
    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $products = array();

    $query = "SELECT PROD_ID, PROD_NAME, PROD_IMAGE, PROD_PRICE, PROD_STATUS, PROD_CATEGORY, PROD_SELLER, SELLERPROD_ID FROM product_tbl";
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
