<?php
session_start();

// 1. Collect form data
$name = $_POST['name'] ?? '';
$address = $_POST['address'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$notes = $_POST['notes'] ?? '';
$cart = $_SESSION['cart'] ?? [];

// cart summary
$cart_summary = "";
$total = 0;
foreach ($cart as $item) {
    $line = $item['name'] . " x " . $item['quantity'] . " = ₹" . ($item['price'] * $item['quantity']);
    $cart_summary .= $line . "\n";
    $total += $item['price'] * $item['quantity'];
}
$cart_summary .= "\nTotal: ₹" . $total;

// 3. Save to MySQL
$conn = new mysqli("localhost", "root", "", "skintique_db"); 
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO orders (name, address, phone, email, notes, cart) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $address, $phone, $email, $notes, $cart_summary);
$stmt->execute();
$stmt->close();
$conn->close();


$admin_email = "yeshashwinig1@gmail.com"; 
$subject = " New Order from $name";
$message = "New order received:\n\nName: $name\nEmail: $email\nPhone: $phone\nAddress:\n$address\n\nCart:\n$cart_summary\n\nNotes:\n$notes";
$headers = "From: no-reply@skintique.com";

mail($admin_email, $subject, $message, $headers);

// 5. Clear cart
unset($_SESSION['cart']);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Order Confirmed</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #fff8f0;
      padding: 40px;
      color: #333;
      text-align: center;
    }
    h1 {
      color: #d6336c;
    }
    .message {
      margin-top: 30px;
      font-size: 18px;
    }
  </style>
</head>
<body>

<h1>Thank You, <?= htmlspecialchars($name) ?>!</h1>
<div class="message">
  Your order has been placed successfully.<br>
  A confirmation has been sent to the admin.<br><br>
  We'll ship it to:<br><strong><?= nl2br(htmlspecialchars($address)) ?></strong>
</div>

</body>
</html>