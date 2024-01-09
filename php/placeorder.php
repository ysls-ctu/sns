<?php
session_start();

if (isset($_SESSION['user']) && isset($_POST['selectedItems']) && isset($_POST['totalAmount']) && isset($_POST['deliveryAddress'])) {
    $userId = $_SESSION['user']['USER_ID'];
    $selectedItems = json_decode($_POST['selectedItems'], true);
    $totalAmount = $_POST['totalAmount'];
    $deliveryAddress = $_POST['deliveryAddress'];

    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $dbname = 'db_shopnswap';

    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        $response = array('status' => 'error', 'message' => 'Database connection failed');
        error_log('Database connection failed');
        echo json_encode($response);
        die();
    }

    $orderDate = date('Y-m-d H:i:s');
    $orderStatus = "TO RECEIVE";

    $insertOrderQuery = "INSERT INTO ORDER_TBL (ORDER_DATE, ORDER_AMOUNT, ORDER_STATUS, ORDER_ADDRESS, USER_ID) VALUES (?, ?, ?, ?, ?)";
    $insertOrderStmt = $conn->prepare($insertOrderQuery);
    $insertOrderStmt->bind_param("ssssi", $orderDate, $totalAmount, $orderStatus, $deliveryAddress, $userId);

    error_log('Insert Order Query: ' . $insertOrderQuery);

    if ($insertOrderStmt->execute()) {
        $orderId = $conn->insert_id;

        foreach ($selectedItems as $item) {
            $insertOrderItemQuery = "INSERT INTO ORDERITEM_TBL (OD_QTY, OD_PRICE, PROD_ID, ORDER_ID) VALUES (?, ?, ?, ?)";
            $insertOrderItemStmt = $conn->prepare($insertOrderItemQuery);
            $insertOrderItemStmt->bind_param("idsi", $item['quantity'], $item['totalPrice'], $item['productId'], $orderId);
            error_log('Insert Order Item Query: ' . $insertOrderItemQuery);

            if ($insertOrderItemStmt->execute()) {
                $insertOrderItemStmt->close();
            } else {
                $response = array('status' => 'error', 'message' => 'Failed to insert order item into ORDERITEM_TBL: ' . $insertOrderItemStmt->error);
                error_log($response['message']);
                echo json_encode($response);
                $insertOrderItemStmt->close();
                $insertOrderStmt->close();
                $conn->close();
                die();
            }
        }

        $response = array('status' => 'success', 'message' => 'Order placed successfully');
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to insert order into ORDER_TBL');
    }

    $insertOrderStmt->close();
    $conn->close();

    ob_clean();

    $response = array('status' => 'success', 'message' => 'Order placed successfully');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Invalid data or user not logged in');
    echo json_encode($response);
}
?>
