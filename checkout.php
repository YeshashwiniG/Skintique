<?php
session_start();
if (empty($_SESSION['cart'])) {
  header("Location: cart.php");
  exit;
}
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #fff8f0;
      padding: 40px;
      color: #333;
    }

    h1 {
      text-align: center;
      color: #d6336c;
    }

    form {
      width: 60%;
      margin: 0 auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      margin-top: 20px;
      font-weight: bold;
    }

    input, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 8px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    button {
      margin-top: 30px;
      background: #d6336c;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
    }

    button:hover {
      background: #b82e5c;
    }
  </style>
</head>
<body>

<h1>Checkout</h1>

<form method="post" action="submit_order.php">
  <label for="name">Full Name</label>
  <input type="text" name="name" required>

  <label for="address">Shipping Address</label>
  <textarea name="address" rows="4" required></textarea>

  <label for="phone">Phone Number</label>
  <input type="tel" name="phone" required>

  <label for="email">Email</label>
  <input type="email" name="email" required>

  <label for="notes">Additional Notes (optional)</label>
  <textarea name="notes" rows="3"></textarea>

  <button type="submit">Place Order</button>
</form>

</body>
</html>