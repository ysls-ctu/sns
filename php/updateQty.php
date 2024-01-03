<?php
session_start();

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['userID'];
    $productId = $_POST['productId'];
    $change = $_POST['change']; // This can be +1 or -1

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

    // Update quantity in the cart_tbl
    $updateQuery = "UPDATE cart_tbl SET quantity = quantity + ? WHERE userId = ? AND productId = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("iii", $change, $userId, $productId);
    $updateStmt->execute();
    $updateStmt->close();
    $conn->close();

    $response = array('status' => 'success', 'message' => 'Quantity updated successfully');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'User not logged in');
    echo json_encode($response);
}
?>
