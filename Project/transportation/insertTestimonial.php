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

//sql to create table
$sql = "CREATE TABLE users(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    date DATE DEFAULT CURRENT_DATE,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table user created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


// $sql = "INSERT INTO testimonials (fullname, review, rating)
// VALUES 
// ('Alice Johnson', 'Great experience, highly recommend!', 5),
// ('Bob Smith', 'Service was okay.', 3),
// ('Charlie Ray', 'Not satisfied with the support.', 2),
// ('Diana Prince', 'Excellent service and friendly staff.', 5),
// ('Ethan Hunt', 'The bus was clean and on time.', 4),
// ('Fiona Apple', 'Had a wonderful trip, will book again!', 5),
// ('George Clooney', 'Average experience, nothing special.', 3),
// ('Hannah Montana', 'Loved the entertainment options on board!', 4),
// ('Ian Somerhalder', 'The booking process was easy and quick.', 5),
// ('Jessica Alba', 'The bus was late, but the ride was comfortable.', 3)";

// if ($conn->multi_query($sql) === TRUE) {
//   echo "New records created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }

$conn->close();
