<?php
session_start();
include "db.php";

if ($_SESSION['role'] != "admin") {
    die("Access Denied");
}

$name = $_POST['name'];
$price = $_POST['price'];
$image = $_POST['image'];
$stock = $_POST['stock'];

$sql = "INSERT INTO products (name,price,image,stock) VALUES ('$name','$price','$image','$stock')";

$conn->query($sql);

echo "Product Added";
?>