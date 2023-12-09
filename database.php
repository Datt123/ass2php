<?php

// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$host = "172.31.22.43"; // Replace with your actual host/IP address
$username = "Datt200552718"; // Replace with your actual username
$password = "Hoe_l7cVUT"; // Replace with your actual password
$dbname = "Datt200552718"; // Replace with your actual database name

// Create a connection to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection to the database was successful

// Use prepared statements to prevent SQL injection
$loginEmail = $_POST["loginEmail"]; // Retrieve entered email from login form
$loginPassword = $_POST["loginPassword"]; // Retrieve entered password from login form

// Perform login validation
$loginQuery = "SELECT * FROM registerdata WHERE email='$loginEmail'"; // SQL query to find user by email
$loginResult = mysqli_query($conn, $loginQuery); // Execute the query

// Bind parameters and execute
if (mysqli_num_rows($loginResult) > 0) {
    // Email exists, retrieve stored password
    $row = mysqli_fetch_assoc($loginResult);
    $storedPassword = $row['password']; // Get password from database for the user

    // Debugging output
    echo "Entered Password: $loginPassword<br>";
    echo "Stored Password: $storedPassword<br>";

    // Validate the entered password with the stored password
    if (password_verify($loginPassword, $storedPassword)) {
        // Password is correct, login successful
        // Redirect to the home page or desired location upon successful login
        header("Location: mainpage.php");
        exit();
    } else {
        // Incorrect password
        echo "Wrong email or password";
    }
} else {
    // Email does not exist in the database
    echo "Wrong email or password";
}

// Close the database connection
mysqli_close($conn);
?>
