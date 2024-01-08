<?php
session_start();

if (isset($_SESSION['user']) && isset($_POST['productId']) && isset($_POST['change'])) {
    $userId = $_SESSION['user']['USER_ID'];
    $productId = $_POST['productId'];
    $change = $_POST['change']; // This can be +1 or -1

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

    // Update quantity in the cart_tbl
    $updateQuery = "UPDATE cart_tbl SET CART_QTY = CART_QTY + ? WHERE USER_ID = ? AND PROD_ID = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("iii", $change, $userId, $productId);

    if ($updateStmt->execute()) {
        // Check if the new quantity is less than or equal to 0
        $newQuantity = $change;
        $checkQuantityQuery = "SELECT CART_QTY FROM cart_tbl WHERE USER_ID = ? AND PROD_ID = ?";
        $checkQuantityStmt = $conn->prepare($checkQuantityQuery);
        $checkQuantityStmt->bind_param("ii", $userId, $productId);
        $checkQuantityStmt->execute();
        $checkQuantityStmt->bind_result($newQuantity);
        $checkQuantityStmt->fetch();
        $checkQuantityStmt->close();

        if ($newQuantity <= 0) {
            // If the new quantity is 0 or below, remove the item from the cart
            $deleteQuery = "DELETE FROM cart_tbl WHERE USER_ID = ? AND PROD_ID = ?";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bind_param("ii", $userId, $productId);
            $deleteStmt->execute();
            $deleteStmt->close();
            $removed = true;
        }
        
        $response = array('status' => 'success', 'message' => 'Quantity updated successfully', 'removed' => $removed ?? false);
        
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to update quantity');
    }

    $updateStmt->close();
    $conn->close();

    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Invalid data or user not logged in');
    echo json_encode($response);
}
?>
