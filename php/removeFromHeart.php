<?php
session_start();

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['USER_ID'];
    $productId = $_POST['productId'];

    // Database connection details
    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $dbname = 'db_shopNswap';

    // Establish a connection to the database
    $conn = new mysqli($host, $user, $pass, $dbname);

    // Check for a successful connection
    if ($conn->connect_error) {
        $response = array('status' => 'error', 'message' => 'Database connection failed');
        echo json_encode($response);
        die();
    }

    // Move product to the cart_tbl
    $moveToCartQuery = "INSERT INTO cart_tbl (USER_ID, PROD_ID, CART_QTY) VALUES (?, ?, 1)";
    $moveToCartStmt = $conn->prepare($moveToCartQuery);
    $moveToCartStmt->bind_param("ii", $userId, $productId);
    $moveToCartStmt->execute();
    $moveToCartStmt->close();

    // Remove product from the heart_tbl
    $deleteQuery = "DELETE FROM heart_tbl WHERE USER_ID = ? AND PROD_ID = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param("ii", $userId, $productId);
    $deleteStmt->execute();
    $deleteStmt->close();

    $conn->close();

    $response = array('status' => 'success', 'message' => 'Product moved to cart and removed from heart list');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'User not logged in');
    echo json_encode($response);
}
?>
