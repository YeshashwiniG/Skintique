<?php
session_start();

// Product list with unique IDs
$products = [
  1 => ['id' => 1, 'name' => 'Sunscreen', 'price' => 799, 'image' => 'images/sunscreen.jpg'],
  2 => ['id' => 2, 'name' => 'Vitamin C', 'price' => 1999, 'image' => 'images/vitamin_c.jpg'],
  3 => ['id' => 3, 'name' => 'Lip Balm', 'price' => 399, 'image' => 'images/lipbalm.jpg'],
  4 => ['id' => 4, 'name' => 'Lipstick', 'price' => 599, 'image' => 'images/lipstick.jpg'],
  5 => ['id' => 5, 'name' => 'Body Moisturizer', 'price' => 999, 'image' => 'images/body_moisturizer.jpg'],
  6 => ['id' => 6, 'name' => 'Soap', 'price' => 199, 'image' => 'images/soap.jpg'],
  7 => ['id' => 7, 'name' => 'Hair Oil', 'price' => 999, 'image' => 'images/hair_oil.jpg'],
  8 => ['id' => 8, 'name' => 'Shampoo', 'price' => 799, 'image' => 'images/shampoo.jpg']
];

// Get product ID from query
$product_id = $_GET['product_id'] ?? null;

if ($product_id && isset($products[$product_id])) {
    $product = $products[$product_id];
    $product['quantity'] = 1;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if product already exists in cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $product['id']) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }
    unset($item); // break reference

    if (!$found) {
        $_SESSION['cart'][] = $product;
    }
}

// Redirect back to product page
$redirect = $_GET['redirect'] ?? 'mini.html';
header("Location: $redirect");
exit;