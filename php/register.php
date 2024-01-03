<?php
    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $dbname = 'sns';
    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signupUsername']) && isset($_POST['signupPassword']) && isset($_FILES['corFile'])) {
        // Validate user input
        $username = $_POST['signupUsername'];
        $password = $_POST['signupPassword'];
        $confirmEmail = $_POST['confirmEmail'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($username != $confirmEmail) {
            echo '<script>alert("Email addresses do not match.");</script>';
        } elseif ($password != $confirmPassword) {
            echo '<script>alert("Passwords do not match.");</script>';
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Upload and validate the COR file (you may want to add more validation here)
            $corFileName = $_FILES['corFile']['name'];
            $corTempName = $_FILES['corFile']['tmp_name'];
            $corFilePath = "cor_uploads/" . $corFileName;

            move_uploaded_file($corTempName, $corFilePath);

            // Insert user data into the database
            $stmt = $conn->prepare("INSERT INTO user_tbl (userEmail, userPassword, corFilePath) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashedPassword, $corFilePath);
            $stmt->execute();
            $stmt->close();

            // Redirect to the login page
            header("Location: shopNswap-login.php");
            exit();
        }
    }

    $conn->close();
?>