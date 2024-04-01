<?php
// Database configuration
$dbHost = 'localhost'; // Your database host
$dbUsername = 'root'; // Your database username
$dbPassword = ''; // Your database password
$dbName = 'georgianilacstudents'; // Corrected database name

// Create the database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Verification
// Verify that the connection is established
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Query the database to check if the username exists
    $query = "SELECT * FROM studentsILAC WHERE name = '$name'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Username exists, retrieve the stored password
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Verify the password
        if (password_verify($password, $stored_password)) {
            // Passwords match, redirect to dashboard or home page
            // You can set session variables here if needed
            header("Location: dashboard.php");
            exit();
        } else {
            // Passwords don't match, display debug info and redirect
            echo "<script>alert('Entered Password: $password\nStored Password: $stored_password');</script>";
            header("Refresh: 0; URL=register.html"); // Redirect immediately
            exit();
        }
    } else {
        // Username doesn't exist, redirect to register.html
        header("Location: register.html");
        exit();
    }
}
?>
