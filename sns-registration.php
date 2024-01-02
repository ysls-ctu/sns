<?php
// sns-registration.php

$host = '127.0.0.1';
$user = 'root';
$pass = '';
$dbname = 'sns';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if email and password are set in the POST request
if (!isset($_POST['email'], $_POST['password'])) {
    http_response_code(400);
    exit('Bad Request');
}

// Start output buffering
ob_start();

// Retrieve form data
$email = $_POST['email'];
$password = $_POST['password'];

// Ensure the directory exists for file uploads
$corUploadsDir = 'cor_uploads/';
if (!is_dir($corUploadsDir)) {
    mkdir($corUploadsDir, 0755, true);
}

// Upload Certificate of Registration (COR) to a server directory and get the file path
$corFileName = basename($_FILES['corFile']['name']);
$corFilePath = $corUploadsDir . $corFileName;
move_uploaded_file($_FILES['corFile']['tmp_name'], $corFilePath);

// Insert data into the database using prepared statements to prevent SQL injection
$sql = "INSERT INTO user_tbl (us_email, us_password, us_cor) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $email, $password, $corFilePath);

// Execute the statement
if ($stmt->execute()) {
    // Redirect to login page using JavaScript after a short delay
    echo '<script>
            setTimeout(function() {
                window.location.href = "shopNswap-login.html";
            }, 3000); // 3000 milliseconds = 3 seconds
          </script>';
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();

