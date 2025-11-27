<?php
session_start();

$index = $_POST['remove_index'] ?? null;

if ($index !== null && isset($_SESSION['cart'][$index])) {
    if ($_SESSION['cart'][$index]['quantity'] > 1) {
        $_SESSION['cart'][$index]['quantity'] -= 1;
    } else {
        // Remove the item completely if quantity is 1
        array_splice($_SESSION['cart'], $index, 1);
    }
}

header("Location: cart.php");
exit;