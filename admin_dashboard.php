<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    die("Access Denied");
}

// USERS
$userCount = $conn->query("SELECT COUNT(*) as total FROM users");
$user = $userCount->fetch_assoc();

// ORDERS
$orderCount = $conn->query("SELECT COUNT(*) as total FROM orders");
$order = $orderCount->fetch_assoc();

// REVENUE
$revenueResult = $conn->query("
    SELECT IFNULL(SUM(total_amount),0) as total 
    FROM orders
");
$revenue = $revenueResult->fetch_assoc();

// STOCK
$stock = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary: #FF69A6;
            --bg: #F1F5F9;
            --sidebar: #ffffff;
            --text: #1E293B;
        }
        body { margin: 0; font-family: 'Inter', sans-serif; background: var(--bg); display: flex; }
        
        /* Sidebar */
        .sidebar { width: 280px; height: 100vh; background: var(--sidebar); border-right: 1px solid #E2E8F0; padding: 25px; position: fixed; display: flex; flex-direction: column; }
        .brand { font-size: 1.5rem; font-weight: 700; color: var(--primary); margin-bottom: 40px; display: flex; align-items: center; gap: 10px; }
        .nav-link { display: flex; align-items: center; gap: 15px; padding: 15px; color: #64748B; text-decoration: none; border-radius: 12px; transition: 0.3s; margin-bottom: 25px; font-weight: 600; }
        .nav-link.active { background: #FFF0F5; color: var(--primary); }
        
        /* Main Content */
        .main { margin-left: 330px; padding: 40px; width: calc(100% - 410px); }
        
        /* Grid Cards */
        .grid-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 40px; }
        .card { background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); transition: 0.3s; }
        .card:hover { transform: translateY(-5px); }
        .card h3 { color: #64748B; font-size: 0.9rem; margin: 0 0 10px 0; }
        .card p { font-size: 1.8rem; font-weight: 700; color: var(--text); margin: 0; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand"><i data-lucide="shopping-bag"></i> BaBee Admin</div>
    <a href="admin_dashboard.php" class="nav-link active"><i data-lucide="layout-dashboard"></i> Dashboard</a>
    <a href="logout.php" class="nav-link" style="margin-top: auto; color: #EF4444;"><i data-lucide="log-out"></i> Logout</a>
</div>

<div class="main">
    <h1>Dashboard Overview</h1>
    
    <!-- Dynamic PHP Data Cards -->
    <div class="grid-stats">
        <div class="card">
            <h3>Total Users</h3>
            <p><?php echo $user['total']; ?></p>
        </div>
        <div class="card">
            <h3>Total Orders</h3>
            <p><?php echo $order['total']; ?></p>
        </div>
        <div class="card">
            <h3>Revenue</h3>
            <p>₹<?php echo $revenue['total']; ?></p>
        </div>
        <div class="card">
            <h3>Products</h3>
            <p><?php echo $stock['total']; ?></p>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>