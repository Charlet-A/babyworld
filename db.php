<?php
$conn = new mysqli("localhost","root","","baby");

if ($conn->connect_error) {
    die("DB Failed");
}
?>