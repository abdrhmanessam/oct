<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_order'])) {
    $request_id = $_POST['request_id'];

    // جلب بيانات الطلب المعلق
    $stmt = $conn->prepare("SELECT * FROM pending_requests WHERE id = ?");
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $request = $stmt->get_result()->fetch_assoc();

    if ($request) {
        // إضافة الطلب إلى جدول `orders`
        $order_number = rand(100000, 999999);
        $stmt = $conn->prepare("INSERT INTO orders (order_number, customer_name, customer_phone, status) VALUES (?, ?, ?, 'تم التأكيد')");
        $stmt->bind_param("sss", $order_number, $request['customer_name'], $request['customer_phone']);
        $stmt->execute();

        // حذف الطلب من جدول `pending_requests`
        $stmt = $conn->prepare("DELETE FROM pending_requests WHERE id = ?");
        $stmt->bind_param("i", $request_id);
        $stmt->execute();

        echo "<script>alert('Order Confirmed!'); window.location='pending_orders.php';</script>";
    }
}

// جلب الطلبات المعلقة
$result = $conn->query("SELECT * FROM pending_requests");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Orders</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: #6a5acd; color: white; }
        button { padding: 5px 10px; background: green; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Pending Orders</h2>
    <table>
        <tr>
            <th>Request ID</th>
            <th>Customer Name</th>
            <th>Phone</th>
            <th>Details</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['customer_name'] ?></td>
                <td><?= $row['customer_phone'] ?></td>
                <td><?= $row['day'] ?>/<?= $row['month'] ?>/<?= $row['year'] ?> - <?= $row['category'] ?> EGP</td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="request_id" value="<?= $row['id'] ?>">
                        <button type="submit" name="confirm_order">Confirm</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>
