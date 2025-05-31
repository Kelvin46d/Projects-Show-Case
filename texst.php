<?php
// Test password hash generation
$password_plain = "Test@1234";

// Optional: Set cost manually
$options = ['cost' => 10];

$hashed = password_hash($password_plain, PASSWORD_BCRYPT, $options);

echo "<h3>Password Hash Test</h3>";
echo "Plain password: <strong>$password_plain</strong><br>";
echo "Generated hash: <strong>$hashed</strong><br>";

// Verify the password
if (password_verify($password_plain, $hashed)) {
    echo "<span style='color: green;'>✅ Password verification successful!</span>";
} else {
    echo "<span style='color: red;'>❌ Password verification failed!</span>";
}
?>
