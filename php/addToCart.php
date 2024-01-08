<?php
session_start();

if (isset($_SESSION['user'])) {
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

    // Retrieve product details including the image
    $productQuery = "SELECT * FROM product_tbl WHERE PROD_ID = ?";
    $productStmt = $conn->prepare($productQuery);
    $productStmt->bind_param("i", $productId);

    try {
        $productStmt->execute();
        $productResult = $productStmt->get_result();

        if ($productResult->num_rows > 0) {
            $productData = $productResult->fetch_assoc();

            // Check if the product already exists in the cart
            $checkQuery = "SELECT * FROM cart_tbl WHERE USER_ID = ? AND PROD_ID = ?";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bind_param("ii", $userId, $productId);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                // Product already exists in the cart, update the quantity
                $updateQuery = "UPDATE cart_tbl SET CART_QTY = CART_QTY + 1 WHERE USER_ID = ? AND PROD_ID = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param("ii", $userId, $productId);
                
                try {
                    $updateStmt->execute();
                } finally {
                    $updateStmt->close();
                }
            } else {
                // Product doesn't exist in the cart, insert a new record
                $insertQuery = "INSERT INTO cart_tbl (USER_ID, PROD_ID, CART_QTY, PROD_PIC) VALUES (?, ?, 1, ?)";
                $insertStmt = $conn->prepare($insertQuery);
                $insertStmt->bind_param("iss", $userId, $productId, $productData['PROD_PIC']);
                
                try {
                    $insertStmt->execute();
                } finally {
                    $insertStmt->close();
                }
            }

            $checkStmt->close();
        }
    } finally {
        $productStmt->close();
        $conn->close();
    }

    // You can fetch the updated product details and return them as JSON
    $response = array('status' => 'success', 'message' => 'Product added to cart');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'User not logged in');
    echo json_encode($response);
}
?>
