<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include "../db.php";

if (!isset($_GET['id'])) {
    die("Card ID is missing.");
}

$card_id = $_GET['id'];

// جلب بيانات الكارت
$stmt = $conn->prepare("SELECT * FROM cards WHERE id = ?");
$stmt->bind_param("i", $card_id);
$stmt->execute();
$card = $stmt->get_result()->fetch_assoc();

if (!$card) {
    die("Card not found.");
}

// تحديث بيانات الكارت
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_card'])) {
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare("UPDATE cards SET day=?, month=?, year=?, category=?, price=?, stock=? WHERE id=?");
    $stmt->bind_param("iiissii", $day, $month, $year, $category, $price, $stock, $card_id);
    $stmt->execute();

    echo "<script>alert('Card updated successfully!'); window.location='manage_cards.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Card</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; padding: 20px; }
        form { max-width: 400px; margin: auto; }
        input, select, button { width: 100%; padding: 10px; margin-top: 10px; }
        button { background: #6a5acd; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Edit Card</h2>
    <form method="POST">
        <label>Day</label>
        <input type="number" name="day" value="<?= $card['day'] ?>" required>
        
        <label>Month</label>
        <input type="number" name="month" value="<?= $card['month'] ?>" required>
        
        <label>Year</label>
        <input type="number" name="year" value="<?= $card['year'] ?>">
        
        <label>Category</label>
        <select name="category">
            <option value="50" <?= $card['category'] == '50' ? 'selected' : '' ?>>50 EGP</option>
            <option value="100" <?= $card['category'] == '100' ? 'selected' : '' ?>>100 EGP</option>
            <option value="200" <?= $card['category'] == '200' ? 'selected' : '' ?>>200 EGP</option>
        </select>
        
        <label>Price</label>
        <input type="number" name="price" value="<?= $card['price'] ?>" required>
        
        <label>Stock</label>
        <input type="number" name="stock" value="<?= $card['stock'] ?>" required>
        
        <button type="submit" name="update_card">Update Card</button>
    </form>

</body>
</html>
