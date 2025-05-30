<?php
session_start();
 /*if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
} */
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'] ?? null;
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare("INSERT INTO cards (day, month, year, category,  price, stock) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiissdi", $day, $month, $year, $category, $price, $stock);
    $stmt->execute();

    echo "<script>alert('Card added successfully!'); window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Card</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

    <h2>Add New Card</h2>
    <form action="" method="post">
        <input type="number" name="day" placeholder="Day" required>
        <input type="number" name="month" placeholder="Month" required>
        <input type="number" name="year" placeholder="Year (optional)">
        <select name="category" required>
            <option value="a">a</option>
            <option value="b">b</option>
            <option value="c">c</option>
        </select>
        
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="number" name="stock" placeholder="Stock" required>
        <button type="submit">Add Card</button>
    </form>

</body>
</html>
