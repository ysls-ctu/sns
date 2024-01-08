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

            // Check if the product already exists in the heart list
            $checkQuery = "SELECT * FROM heart_tbl WHERE USER_ID = ? AND PROD_ID = ?";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bind_param("ii", $userId, $productId);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                // Product already exists in the heart list, handle as needed
                $response = array('status' => 'error', 'message' => 'Product already in heart list');
                echo json_encode($response);
            } else {
                // Product doesn't exist in the heart list, insert a new record
                $insertQuery = "INSERT INTO heart_tbl (USER_ID, PROD_ID, PROD_PIC) VALUES (?, ?, ?)";
                $insertStmt = $conn->prepare($insertQuery);
                $insertStmt->bind_param("iis", $userId, $productId, $productData['PROD_PIC']);

                try {
                    $insertStmt->execute();
                } finally {
                    $insertStmt->close();
                }

                $response = array('status' => 'success', 'message' => 'Product added to heart list');
                echo json_encode($response);
            }

            $checkStmt->close();
        }
    } finally {
        $productStmt->close();
        $conn->close();
    }
} else {
    $response = array('status' => 'error', 'message' => 'User not logged in');
    echo json_encode($response);
}
?>
