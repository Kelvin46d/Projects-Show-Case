<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mySupDB ";
$double_quote = '"';
$quote = "'";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, fullname, email,password_  , retypassword_ , FROM signUp ";
$result = $conn->query($sql);

if ($result->num_rows > 0) { 
  echo "<table>
  <tr>
     <th>Id</th>
     <th>Name</th>
     <th>Email</th>
     <th>Password</th>
     <th>Re-Type-Password</th>
   </tr>";

  while ($row = $result->fetch_assoc()) {
    echo "<tr id='row_" . $row["id"] . "'>
            <td>" . $row["id"] . "</td>
            <td>" . $row["fullname"] . "</td>
            <td>" . $row["email"] . "</td>
            <td>" . $row["website"] . "</td>
            <td>" . $row["comments"] . "</td>
            <td>" . $row["gender"] . "</td>
            <td>
                <input type='button' value='" . $row["id"] . "' onclick='showComment(" . $double_quote . $row["id"] . $double_quote . ")'>
                <input type='hidden' id='comment_text" . $row["id"] . "' value='" . $row["comments"] . "'>
                
            </td>
        </tr>";
  }

  echo "</table>";
  echo "<textarea id='comments'></textarea>"; 
} else {
  echo "0 results";
}
$conn->close();
?>

<script>
// JavaScript function to display comment and alert ID
function showComment(id) {
    alert("ID: " + id); // Show alert with ID
    const hiddenComment = document.getElementById("comment_text" + id).value;
    const textarea = document.getElementById("comments");
    textarea.value = hiddenComment; // Display the hidden comment in the textarea
}
</script>
