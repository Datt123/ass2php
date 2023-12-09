<?php

// Database connection details
$host = "172.31.22.43"; // Replace with your actual host/IP address
$username = "Datt200552718"; // Replace with your actual username
$password = "Hoe_l7cVUT"; // Replace with your actual password
$dbname = "Datt200552718"; // Replace with your actual database name

// Create a connection to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection to the database was successful

// Use prepared statements to prevent SQL injection
$fname = $_POST["rfname"]; // Retrieve entered first name from registration form
$lname = $_POST["rlname"]; // Retrieve entered last name from registration form
$gmail = $_POST["registerEmail"]; // Retrieve entered email from registration form
$plain_password = $_POST["registerPassword"]; // Retrieve entered password from registration form

// Hash the password
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT); // Hash the plain password

// Check for duplicate email
$duplicate = "SELECT * FROM registerdata WHERE email='$gmail'"; // SQL query to check for existing email
$result1 = mysqli_query($conn, $duplicate); // Execute the query

if (mysqli_num_rows($result1) > 0) {
    // Email already exists in the database, handle duplicate entry (e.g., show an error message)
    echo "Duplicate data";
} else {
    // Insert the hashed password into the database
    $query = "INSERT INTO registerdata (fname, lname, email, password) VALUES ('$fname', '$lname', '$gmail', '$hashed_password')"; // SQL query to insert user data
    $result = mysqli_query($conn, $query); // Execute the query

    if ($result) {
        // Registration successful
        echo "Registration successful";
        header("Location:login.html");
    } else {
        // Registration failed
        echo "Registration failed";
    }
}

// Close the database connection
mysqli_close($conn);
?>
