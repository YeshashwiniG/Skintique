<?php
session_start();

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "skintique_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username (from session OR form)
$username = $_SESSION["username"] ?? ($_POST["username"] ?? null);
$message  = $_POST["message"] ?? null;

// Validate inputs
if (empty($username) || empty($message)) {
    die("Error: Username and message are required.");
}

// Save to database
$stmt = $conn->prepare("INSERT INTO feedback (username, message) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $message);

if (!$stmt->execute()) {
    die("Database error: " . $stmt->error);
}
$stmt->close();

// Send email to admin
$admin_email = "yeshashwinig1@gmail.com";
$subject = "New Feedback from $username";
$body    = "User '$username' submitted feedback:\n\n$message";
$headers = "From: no-reply@skintique.com";

mail($admin_email, $subject, $body, $headers);

// Redirect to thank-you page
header("Location: submit.html");
exit();
?>