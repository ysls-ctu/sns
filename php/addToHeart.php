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

    // Check if the product already exists in the heart list
    $checkQuery = "SELECT * FROM heart_tbl WHERE userId = ? AND productId = ?";
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
        $insertQuery = "INSERT INTO heart_tbl (userId, productId) VALUES (?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("ii", $userId, $productId);
        $insertStmt->execute();

        $response = array('status' => 'success', 'message' => 'Product added to heart list');
        echo json_encode($response);
    }

    $insertStmt->close();
    $checkStmt->close();
    $conn->close();
} else {
    $response = array('status' => 'error', 'message' => 'User not logged in');
    echo json_encode($response);
}
?>
