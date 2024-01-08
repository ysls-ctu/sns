<?php
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

// Create the directory if it doesn't exist
$targetDir = __DIR__ . "productImages/"; // Adjusted path
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}

// Get form data
$productName = $_POST['productName'];
$productPrice = $_POST['productPrice'];
$productStatus = $_POST['productStatus'];
$productCategory = $_POST['productCategory'];

$productImage = ''; // Placeholder for the image path

if ($_FILES['productImage']['error'] == 0) {
    $filename = strtolower(basename($_FILES['productImage']['name']));
    $targetFile = $targetDir . $filename;

    if (move_uploaded_file($_FILES['productImage']['tmp_name'], $targetFile)) {
        $productImage = 'productImages/' . $filename; // Adjusted relative path
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Failed to move uploaded file']);
        exit;
    }
}

// Insert data into the database
$sql = "INSERT INTO PRODUCT_TBL (PROD_NAME, PROD_IMAGE, PROD_PRICE, PROD_STATUS, PROD_CATEGORY)
        VALUES ('$productName', '$productImage', '$productPrice', '$productStatus', '$productCategory')";

if ($conn->query($sql) === TRUE) {
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

// Close the database connection
$conn->close();
?>
