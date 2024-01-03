<?php
session_start();

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['userID'];

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

    // Fetch cart items for the user
    $query = "SELECT c.*, p.prod_img, p.prod_name, p.prod_seller, p.prod_price FROM cart_tbl c
              JOIN product_tbl p ON c.productId = p.prod_id
              WHERE c.userId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $cartItems = array();

    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }

    $stmt->close();
    $conn->close();

    // Return cart items as JSON
    echo json_encode($cartItems);
} else {
    $response = array('status' => 'error', 'message' => 'User not logged in');
    echo json_encode($response);
}
?>
