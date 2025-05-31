<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ndaya_bus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE messagecontact(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 fullname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table MySignUp2 created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
$conn->close();
?>