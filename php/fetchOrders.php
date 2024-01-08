<?php
// Function to fetch user orders based on status
function fetchUserOrders($userId, $orderStatus = null) {
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

    // Fetch user orders based on status
    $query = "SELECT * FROM order_tbl WHERE USER_ID = ?";

    // If $orderStatus is provided, add it to the query
    if ($orderStatus !== null) {
        $query .= " AND ORDER_STATUS = ?";
    }

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        // Handle the error, e.g., echo $conn->error;
        echo "Error in preparing statement";
        $conn->close();
        return null;
    }

    // If $orderStatus is provided, bind it to the statement
    if ($orderStatus !== null) {
        $stmt->bind_param("is", $userId, $orderStatus);
    } else {
        $stmt->bind_param("i", $userId);
    }

    if (!$stmt->execute()) {
        // Handle the error, e.g., echo $stmt->error;
        echo "Error in executing statement";
        $stmt->close();
        $conn->close();
        return null;
    }

    $result = $stmt->get_result();

    $userOrders = array();
    $totalToReceive = 0; // Initialize total to zero

    while ($row = $result->fetch_assoc()) {
        $userOrders[] = $row;

        // Check if the order has ORDER_STATUS "TO RECEIVE" and add the amount to the total
        if ($orderStatus === "TO RECEIVE") {
            $totalToReceive += $row['ORDER_AMOUNT'];
        }
    }

    $stmt->close();
    $conn->close();

    // Return user orders and total
    return array('userOrders' => $userOrders, 'totalToReceive' => $totalToReceive);
}
?>
