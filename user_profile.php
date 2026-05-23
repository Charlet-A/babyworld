<?php
session_start();

if ($_SESSION['role'] != "user") {
    die("Access Denied");
}

echo "<h1>User Profile</h1>";
echo "<p>Only basic features allowed</p>";
?>