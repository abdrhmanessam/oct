<?php
session_start();
/*if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
} */
include "../db.php";

// جلب البيانات
$cards = $conn->query("SELECT * FROM cards ORDER BY created_at DESC");
$orders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
$pending = $conn->query("SELECT * FROM pending_requests ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

    <h2>Admin Panel</h2>
    
    <h3>Available Cards</h3>
    <table border="1">
        <tr>
            <th>Category</th>
            <th>Date</th>
            <th>Price</th>
            <th>Stock</th>
        </tr>
        <?php while ($card = $cards->fetch_assoc()): ?>
        <tr>
            <td><?= $card['category'] ?> EGP</td>
            <td><?= $card['day'] ?>/<?= $card['month'] ?>/<?= $card['year'] ?? '—' ?></td>
            <td><?= $card['price'] ?> EGP</td>
            <td><?= $card['stock'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h3>Pending Requests</h3>
    <table border="1">
        <tr>
            <th>Request Number</th>
            <th>Customer</th>
            <th>Category</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        <?php while ($req = $pending->fetch_assoc()): ?>
        <tr>
            <td><?= $req['request_number'] ?></td>
            <td><?= $req['customer_name'] ?> (<?= $req['customer_phone'] ?>)</td>
            <td><?= $req['category'] ?> EGP</td>
            <td><?= $req['day'] ?>/<?= $req['month'] ?>/<?= $req['year'] ?? '—' ?></td>
            <td><?= $req['status'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h3>Orders</h3>
    <table border="1">
        <tr>
            <th>Order Number</th>
            <th>Customer</th>
            <th>Category</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        <?php while ($order = $orders->fetch_assoc()): ?>
        <tr>
            <td><?= $order['order_number'] ?></td>
            <td><?= $order['customer_name'] ?> (<?= $order['customer_phone'] ?>)</td>
            <td><?= $order['category'] ?> EGP</td>
            <td><?= $order['day'] ?>/<?= $order['month'] ?>/<?= $order['year'] ?? '—' ?></td>
            <td><?= $order['status'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a href="logout.php">Logout</a>

</body>
</html>
