<?php

function fetchBorrowFromDatabase() {
    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $dbname = 'db_shopnswap';
    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $rent = array();

    $query = "SELECT BORROW_ID, BORROW_NAME, BORROW_IMAGE, USER_ID FROM borrow_tbl";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rent[] = $row;
        }
    }

    $conn->close();

    return $rent;
}

?>