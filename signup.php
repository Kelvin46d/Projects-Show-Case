
<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert user data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email already exists
    $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
if (!$checkStmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo "Email already registered. <a href='index.html'>Try again</a>";
    } else {
        // Insert new user
        $insertStmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
       
       if (!$insertStmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
       
       
        $insertStmt->bind_param("ss", $email, $password);
        
        if ($insertStmt->execute()) {
            echo "Signup successful. <a href='login.html'>Log In</a>";
        } else {
            echo "Error: " . $insertStmt->error;
        }

        $insertStmt->close();
    }

    $checkStmt->close();
}

$conn->close();
?>







<?php
// $servername = "localhost";
// $username = "root";
// $password = ""; // Replace with your MySQL password
// $dbname = "user_db";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
//}

// Insert user data
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $email = $_POST['email'];
//     $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

//     $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

//     if ($conn->query($sql) === TRUE) {
//         echo "Signup successful. <a href='login.html'>Log In</a>";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// }

// $conn->close();
// ?>
