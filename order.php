<?php
include "db.php";

if (isset($_GET['id'])) {
    $card_id = $_GET['id'];
    $card = $conn->query("SELECT * FROM cards WHERE id = $card_id")->fetch_assoc();
    
    if (!$card) {
        die("Card not found!");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $card_id = $_POST['card_id'];

    function generateOrderNumber() {
        return strtoupper(substr(md5(time() . rand()), 0, 6));
    }
    $order_number = generateOrderNumber();

    $stmt = $conn->prepare("INSERT INTO orders (order_number, card_id, customer_name, customer_phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $order_number, $card_id, $customer_name, $customer_phone);
    $stmt->execute();

    $conn->query("UPDATE cards SET stock = stock - 1 WHERE id = $card_id");

    echo "<script>alert('تم تأكيد طلبك! كود الطلب: $order_number');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order a Card</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

    <h2>Order <?= $card['category'] ?> EGP - <?= $card['day'] ?>/<?= $card['month'] ?>/<?= $card['year'] ?? '—' ?></h2>
    <form action="" method="post">
        <input type="hidden" name="card_id" value="<?= $card['id'] ?>">
        <input type="text" name="customer_name" placeholder="Your Name" required>
        <input type="text" name="customer_phone" placeholder="Phone Number" required>
        <button type="submit">Confirm Order</button>
    </form>

</body>
</html>
