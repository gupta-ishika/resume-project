<?php
// These are the login credentials for your local MySQL database using XAMPP.

$servername = "localhost"; // The address of the database server
$username = "root";        // The default username for XAMPP
$password = "";            // The default password for XAMPP is empty
$dbname = "resume_db";     // The name of the database you created in phpMyAdmin


// This line creates the actual connection to the database.
$conn = new mysqli($servername, $username, $password, $dbname);


// This checks if the connection failed.
// If it did, it will stop the script and show an error message.
// This is very useful for debugging!
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>