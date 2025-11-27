<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <style>
    :root {
      --primary: #d6336c;
      --accent: #ffe0e6;
      --light: #fff8f0;
      --text-dark: #333;
      --text-light: #a0003c;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: var(--light);
      margin: 0;
      padding: 40px;
      color: var(--text-dark);
    }

    h1 {
      text-align: center;
      color: var(--primary);
    }

    table {
      width: 80%;
      margin: 30px auto;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 16px;
      text-align: center;
      font-size: 16px;
    }

    th {
      background: var(--primary);
      color: white;
    }

    tr:nth-child(even) {
      background: var(--accent);
    }

    tr:hover {
      background: #ffd6e0;
    }

    .remove-btn {
      background: var(--primary);
      color: white;
      padding: 6px 12px;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
    }

    .remove-btn:hover {
      background: #b82e5c;
    }

    .total {
      text-align: right;
      width: 80%;
      margin: 20px auto;
      font-size: 20px;
      font-weight: bold;
    }

    .empty {
      text-align: center;
      margin-top: 60px;
      font-size: 18px;
      color: var(--text-light);
    }
  </style>
</head>
<body>

<h1>Your Shopping Cart</h1>

<?php if (!empty($_SESSION['cart'])): ?>
  <table>
    <tr>
      <th>Product</th>
      <th>Price (Rs)</th>
      <th>Quantity</th>
      <th>Subtotal (Rs)</th>
      <th>Action</th>
    </tr>
    <?php
    $total = 0;
    foreach ($_SESSION['cart'] as $index => $item):
      $subtotal = $item['price'] * $item['quantity'];
      $total += $subtotal;
    ?>
    <tr>
      <td><?= htmlspecialchars($item['name']) ?></td>
      <td><?= number_format($item['price']) ?></td>
      <td><?= $item['quantity'] ?></td>
      <td><?= number_format($subtotal) ?></td>
      <td>
        <form method="post" action="remove_from_cart.php">
          <input type="hidden" name="remove_index" value="<?= $index ?>">
          <button type="submit" class="remove-btn">Remove</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>

  <div class="total">Total: ₹<?= number_format($total) ?></div>
<?php else: ?>
  <div class="empty">Your cart is currently empty.</div>
<?php endif; ?>

<?php if (!empty($_SESSION['cart'])): ?>
  <form method="post" action="checkout.php" style="text-align: center; margin-top: 30px;">
    <button type="submit" class="remove-btn" style="font-size: 18px; padding: 10px 20px;">Buy Now</button>
  </form>
<?php endif; ?>

</body>
</html>