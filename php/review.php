<?php
session_start();

if (isset($_SESSION['user']) && isset($_POST['orderId']) && isset($_POST['rating']) && isset($_POST['comment'])) {
    $userId = $_SESSION['user']['USER_ID'];
    $orderId = $_POST['orderId'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

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

    // Insert review into the review_tbl
    $insertReviewQuery = "INSERT INTO review_tbl (ORDER_ID, USER_ID, REVIEW_RATING, REVIEW_COMMENT) VALUES (?, ?, ?, ?)";
    $insertReviewStmt = $conn->prepare($insertReviewQuery);
    $insertReviewStmt->bind_param("iiis", $orderId, $userId, $rating, $comment);

    if ($insertReviewStmt->execute()) {
        // Update order status in the order_tbl
        $updateOrderQuery = "UPDATE order_tbl SET ORDER_STATUS = 'COMPLETED' WHERE ORDER_ID = ?";
        $updateOrderStmt = $conn->prepare($updateOrderQuery);
        $updateOrderStmt->bind_param("i", $orderId);
        $updateOrderStmt->execute();
        $updateOrderStmt->close();

        $response = array('status' => 'success', 'message' => 'Review submitted successfully');
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to submit review');
    }

    $insertReviewStmt->close();
    $conn->close();

    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Invalid data or user not logged in');
    echo json_encode($response);
}
?>
