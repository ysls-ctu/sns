<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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

// Check if the request is POST and if email and password are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signupUsername']) && isset($_POST['signupPassword'])) {
    $email = $_POST['signupUsername'];
    $password = $_POST['signupPassword'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Get the current timestamp
    $registrationDate = date('Y-m-d H:i:s');

    // Insert user data into the database
    $stmt = $conn->prepare("INSERT INTO user_tbl (USER_EMAIL, USER_PASS, USER_REGDATE) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $hashedPassword, $registrationDate);
    $stmt->execute();
    $stmt->close();

    // Set a success response
    $response = array('status' => 'success', 'message' => 'Account created successfully.');
    echo json_encode($response);
}

$conn->close();
?>
