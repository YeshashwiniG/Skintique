<?php
session_start();

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "skintique_db");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get login form data
$username = $_POST["username"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Secure password

// Save login to database
$stmt = $conn->prepare("INSERT INTO logins (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$stmt->close();

// Start session
$_SESSION["username"] = $username;

// Send email to admin
$admin_email = "yeshashwinig1@gmail.com"; // Replace with your actual email
$subject = "New Login Alert";
$message = "User '$username' just logged in.";
$headers = "From: no-reply@skintique.com";
mail($admin_email, $subject, $message, $headers);

echo "<script>
        alert('Login successful! Email sent.');
        window.location.href='mini.html';
      </script>";
?>