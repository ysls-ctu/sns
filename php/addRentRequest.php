<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    // User is logged in, you can access user data
    $userData = $_SESSION['user'];

    // Get user_id from session data
    $user_id = $userData['USER_ID'];

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
    $rentreqDur = $_POST['rentreqDur'];
    $rentreqComment = $_POST['rentreqComment'];

    // Insert data into the database
    $sql = "INSERT INTO RENTREQ_TBL (RR_DUR, RR_COMMENT, user_id)
            VALUES ('$rentreqDur', '$rentreqComment', '$user_id')";

    if ($conn->query($sql) === TRUE) {
        // Retrieve the last inserted ID (rent_id)
        $rent_id = $conn->insert_id;

        // Use $rent_id in your application logic as needed

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'rent_id' => $rent_id]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }

    // Close the database connection
    $conn->close();
} else {
    // User is not logged in, redirect to login page or handle as needed
    header('Location: shopNswap-login.php');
    exit();
}
?>
