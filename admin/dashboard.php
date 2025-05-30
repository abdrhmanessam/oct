<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include "../db.php";

// إحصائيات سريعة
$total_cards = $conn->query("SELECT COUNT(*) AS count FROM cards")->fetch_assoc()['count'];
$total_orders = $conn->query("SELECT COUNT(*) AS count FROM orders WHERE status = 'تم التأكيد'")->fetch_assoc()['count'];
$pending_requests = $conn->query("SELECT COUNT(*) AS count FROM pending_requests WHERE status = 'في الانتظار'")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; padding: 20px; background: #f4f4f4; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; color: #6a5acd; }
        .stats { display: flex; justify-content: space-between; margin-top: 20px; }
        .card { background: #6a5acd; color: white; padding: 20px; border-radius: 5px; text-align: center; width: 30%; }
        .card h3 { margin: 0; }
        .links { margin-top: 20px; }
        .btn { display: block; text-align: center; padding: 10px; margin: 5px 0; background: #6a5acd; color: white; border-radius: 5px; text-decoration: none; }
    </style>
</head>
<body>

    <div class="container">
        <h2>Admin Dashboard</h2>
        <div class="stats">
            <div class="card">
                <h3><?= $total_cards ?></h3>
                <p>Available Cards</p>
            </div>
            <div class="card">
                <h3><?= $total_orders ?></h3>
                <p>Confirmed Orders</p>
            </div>
            <div class="card">
                <h3><?= $pending_requests ?></h3>
                <p>Pending Requests</p>
            </div>
        </div>

        <div class="links">
            <a href="manage_cards.php" class="btn"><i class="fa fa-credit-card"></i> Manage Cards</a>
            <a href="confirmed_orders.php" class="btn"><i class="fa fa-check"></i> Confirmed Orders</a>
            <a href="pending_requests.php" class="btn"><i class="fa fa-clock"></i> Pending Requests</a>
            <a href="logout.php" class="btn" style="background: red;"><i class="fa fa-sign-out"></i> Logout</a>
        </div>
    </div>

</body>
</html>
