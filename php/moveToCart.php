<?php
session_start();

if (isset($_SESSION['user']) && isset($_POST['productId'])) {
    $userId = $_SESSION['user']['USER_ID'];
    $productId = $_POST['productId'];

    // Database connection details
    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $dbname = 'db_shopnswap';

    // Establish a connection to the database
    $conn = new mysqli($host, $user, $pass, $dbname);

    // Check for a successful connection
    if ($conn->connect_error) {
        $response = array('status' => 'error', 'message' => 'Database connection failed');
        echo json_encode($response);
        die();
    }

    // Check if the product already exists in the cart
    $checkCartQuery = "SELECT CART_QTY FROM cart_tbl WHERE USER_ID = ? AND PROD_ID = ?";
    $checkCartStmt = $conn->prepare($checkCartQuery);
    $checkCartStmt->bind_param("ii", $userId, $productId);
    $checkCartStmt->execute();
    $checkCartStmt->store_result();

    if ($checkCartStmt->num_rows > 0) {
        // Product already exists in the cart, update the quantity
        $checkCartStmt->bind_result($existingQty);
        $checkCartStmt->fetch();

        $updateQtyQuery = "UPDATE cart_tbl SET CART_QTY = CART_QTY + 1 WHERE USER_ID = ? AND PROD_ID = ?";
        $updateQtyStmt = $conn->prepare($updateQtyQuery);
        $updateQtyStmt->bind_param("ii", $userId, $productId);
        $updateQtyStmt->execute();
        $updateQtyStmt->close();
    } else {
        // Product doesn't exist in the cart, insert a new row
        $insertQuery = "INSERT INTO cart_tbl (USER_ID, PROD_ID, CART_QTY) VALUES (?, ?, 1)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("ii", $userId, $productId);
        $insertStmt->execute();
        $insertStmt->close();
    }

    $checkCartStmt->close();
    $conn->close();

    $response = array('status' => 'success', 'message' => 'Product moved to cart successfully');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Invalid data or user not logged in');
    echo json_encode($response);
}
?>
