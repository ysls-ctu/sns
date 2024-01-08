<?php
session_start();
ob_start();

// Database connection
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$dbname = 'db_shopnswap';
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is POST and if username and password are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username and password are not empty
    if ($username != "" && $password != "") {
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM user_tbl WHERE USER_EMAIL = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows > 0) {
            // User exists, fetch user data
            $userData = $result->fetch_assoc();
        
            // After fetching user data...
            if (password_verify($password, $userData['USER_PASS'])) {
                // Password is correct, respond with JSON
                header('Content-Type: application/json');
                $_SESSION['user'] = $userData; // Set the session variable
                $response = [
                    'status' => 'success',
                    'message' => 'Login successful',
                    'userData' => $userData
                ];
                echo json_encode($response);
            } else {
                // Password is incorrect, respond with JSON
                header('Content-Type: application/json');
                $response = [
                    'status' => 'error',
                    'message' => 'Incorrect password. Double-check your login credentials.'
                ];
                echo json_encode($response);
            }
        } 

        $stmt->close();
    } else {
        // Email Address and Password must not be empty, respond with JSON
        header('Content-Type: application/json');
        $response = [
            'status' => 'error',
            'message' => 'Email Address and Password must not be empty.'
        ];
        echo json_encode($response);
    }
}

$conn->close();
ob_end_flush(); // Flush the output buffer and send it to the browser
?>