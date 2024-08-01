<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "dame";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        // Registration logic
        $sql = "INSERT INTO users (user_id, username) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $user_id, $username);
        
        // Example data, replace with actual data from fingerprint registration
        $user_id = 'example_user_id';
        $username = 'example_user_name';

        if ($stmt->execute()) {
            echo "Fingerprint registered successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } elseif (isset($_POST['login'])) {
        // Login logic
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        
        // Example data, replace with actual data from fingerprint authentication
        $user_id = 'example_user_id';

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Login successful.";
        } else {
            echo "No user found.";
        }

        $stmt->close();
    }
}

$conn->close();
?>
