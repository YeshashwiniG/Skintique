<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];

  $file = fopen("feedback.txt", "a");
  fwrite($file, "Name: $name\nEmail: $email\nMessage: $message\n---\n");
  fclose($file);

  header("Location: submit.html");
  exit();
}
?>