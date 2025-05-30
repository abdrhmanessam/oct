<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include "../db.php";

// جلب الطلبات المؤكدة
$result = $conn->query("SELECT * FROM orders WHERE status = 'تم التأكيد'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmed Orders</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: #6a5acd; color: white; }
    </style>
</head>
<body>

    <h2>Confirmed Orders</h2>
    <table>
        <tr>
            <th>Order Number</th>
            <th>Customer Name</th>
            <th>Phone</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['order_number'] ?></td>
                <td><?= $row['customer_name'] ?></td>
                <td><?= $row['customer_phone'] ?></td>
                <td><?= $row['status'] ?></td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>
