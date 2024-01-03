<?php
session_start();

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['userID']; 
    $productId = $_POST['productId'];

    // Database connection details
    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $dbname = 'sns';

    // Establish a connection to the database
    $conn = new mysqli($host, $user, $pass, $dbname);

    // Check for a successful connection
    if ($conn->connect_error) {
        $response = array('status' => 'error', 'message' => 'Database connection failed');
        echo json_encode($response);
        die();
    }

    // Check if the product already exists in the cart
    $checkQuery = "SELECT * FROM cart_tbl WHERE userId = ? AND productId = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("ii", $userId, $productId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Product already exists in the cart, update the quantity
        $updateQuery = "UPDATE cart_tbl SET quantity = quantity + 1 WHERE userId = ? AND productId = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ii", $userId, $productId);
        $updateStmt->execute();
    } else {
        // Product doesn't exist in the cart, insert a new record
        $insertQuery = "INSERT INTO cart_tbl (userId, productId, quantity) VALUES (?, ?, 1)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("ii", $userId, $productId);
        $insertStmt->execute();
    }

    $insertStmt->close();
    $checkStmt->close();
    $conn->close();

    // You can fetch the updated product details and return them as JSON
    $response = array('status' => 'success', 'message' => 'Product added to cart');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'User not logged in');
    echo json_encode($response);
}
?>
