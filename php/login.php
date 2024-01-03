<?php
    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $dbname = 'sns';
    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username != "" && $password != "") {
            // Use prepared statement to prevent SQL injection
            $stmt = $conn->prepare("SELECT * FROM user_tbl WHERE userEmail = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // User exists, fetch hashed password
                $userData = $result->fetch_assoc();
                $hashedPasswordFromDB = $userData['userPassword'];

                // Verify the provided password against the hashed password from the database
                if (password_verify($password, $hashedPasswordFromDB)) {
                    // Password is correct, proceed

                    // Show terms modal and pass user information to JavaScript
                    echo '<script>
                            document.getElementById("termsModal").style.display = "flex";
                            var userData = ' . json_encode($userData) . ';
                        </script>';
                } else {
                    // Password is incorrect, show alert
                    echo '<script>alert("Incorrect password. Double-check your login credentials.");</script>';
                }
            } else {
                // User does not exist, show alert
                echo '<script>alert("Account does not exist. Double-check your login credentials.");</script>';
            }

            $stmt->close();
        }
        else {
            echo '<script>alert("Email Address and Password must not be empty.");</script>';
        }
    }

    $conn->close();
?>