<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include "../db.php";

// حذف كارت
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_card'])) {
    $card_id = $_POST['card_id'];
    $stmt = $conn->prepare("DELETE FROM cards WHERE id = ?");
    $stmt->bind_param("i", $card_id);
    $stmt->execute();
    echo "<script>alert('Card deleted successfully!'); window.location='manage_cards.php';</script>";
}

// جلب كل الكروت
$result = $conn->query("SELECT * FROM cards");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cards</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: #6a5acd; color: white; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 5px; }
        .edit { background: orange; }
        .delete { background: red; }
    </style>
</head>
<body>

    <h2>Manage Cards</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['day'] ?>/<?= $row['month'] ?>/<?= $row['year'] ?></td>
                <td><?= $row['category'] ?> EGP</td>
                <td><?= $row['price'] ?> EGP</td>
                <td><?= $row['stock'] ?></td>
                <td>
                    <a href="edit_card.php?id=<?= $row['id'] ?>" class="btn edit">Edit</a>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="card_id" value="<?= $row['id'] ?>">
                        <button type="submit" name="delete_card" class="btn delete" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>
