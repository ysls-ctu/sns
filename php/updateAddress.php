<?php
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

// Get the new address from the POST request
$newAddress = $_POST['newAddress'];

// Assuming you have the user's ID from the session
session_start();
$userId = $_SESSION['user']['USER_ID'];

// Update the USER_ADDRESS in the USER_TBL
$query = "UPDATE user_tbl SET USER_ADDRESS = ? WHERE USER_ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $newAddress, $userId);
$stmt->execute();

// Check if the update was successful
if ($stmt->affected_rows > 0) {
    $response = array('status' => 'success', 'message' => 'Address updated successfully');
} else {
    $response = array('status' => 'error', 'message' => 'Failed to update address');
}

// Close the database connection
$stmt->close();
$conn->close();

// Return the response as JSON
echo json_encode($response);
?>
