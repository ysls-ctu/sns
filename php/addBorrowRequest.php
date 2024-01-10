<?php
// Database connection details
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$dbname = 'db_shopnswap';

// Establish a connection to the database
$conn = new mysqli($host, $user, $pass, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$borrowreqCategory = $_POST['borrowreqCategory'];
$borrowreqComment = $_POST['borrowreqComment'];

// Insert data into the database
$sql = "INSERT INTO BORROWREQ_TBL (BR_CATEGORY, BR_COMMENT)
        VALUES ('$borrowreqCategory', '$borrowreqComment')";

if ($conn->query($sql) === TRUE) {
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

// Close the database connection
$conn->close();
?>