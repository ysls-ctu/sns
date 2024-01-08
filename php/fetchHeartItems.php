<?php
function fetchHeartItems() {
    // Check if the user is logged in
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user']['USER_ID'];

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

        // Fetch heart items for the user with additional details from the product_tbl and user_tbl
        $query = "SELECT h.*, p.PROD_NAME, u.USER_EMAIL, p.PROD_PRICE
                  FROM heart_tbl h
                  JOIN product_tbl p ON h.PROD_ID = p.PROD_ID
                  JOIN user_tbl u ON h.USER_ID = u.USER_ID
                  WHERE h.USER_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $heartItems = array();

        while ($row = $result->fetch_assoc()) {
            $heartItems[] = $row;
        }

        $stmt->close();
        $conn->close();

        // Return heart items as an array
        return $heartItems;
    } else {
        $response = array('status' => 'error', 'message' => 'User not logged in');
        echo json_encode($response);
        return null;
    }
}
?>
