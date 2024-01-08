<?php
function fetchUserAddress($userId) {
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

    // Fetch user address
    $query = "SELECT USER_ADDRESS FROM user_tbl WHERE USER_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $address = null;

    if ($row = $result->fetch_assoc()) {
        $address = $row['USER_ADDRESS'];
    }

    $stmt->close();
    $conn->close();

    // Return user address
    return $address;
}
?>
