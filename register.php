<?php
include "db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$check = $conn->query("SELECT * FROM users WHERE email='$email'");

if ($check->num_rows > 0) {
    die("Email already exists");
}

$conn->query("INSERT INTO users(name,email,password,role)
VALUES('$name','$email','$password','user')");

header("Location: login.html?msg=success");
?>