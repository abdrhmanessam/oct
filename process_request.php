<?php
include "db.php";

if (isset($_GET['day']) && isset($_GET['month']) && isset($_GET['plan'])) {
    $day = intval($_GET['day']);
    $month = intval($_GET['month']);
    $year = isset($_GET['year']) ? intval($_GET['year']) : NULL; // السنة مطلوبة فقط في الـ Premium و Gold
    $plan = $_GET['plan'];

    // تحديد الفئة المناسبة بناءً على الخطة
    if ($plan == 'basic') {
        $category = 'b';
        $price = 50;
    } elseif ($plan == 'premium') {
        $category = 'b';
        $price = 80;
    } elseif ($plan == 'gold' && isset($_GET['category'])) {
        $category = 'a';
        $price = intval($_GET['category']); // السعر بيكون بناءً على الفئة A (50, 100, 200)
    } else {
        echo "Invalid plan selection.";
        exit;
    }

    // بناء استعلام البحث
    $sql = "SELECT * FROM cards WHERE day = $day AND month = $month AND category = '$category'";
    if ($plan == 'premium' || $plan == 'gold') {
        $sql .= " AND year = $year";
    }

    $result = $conn->query($sql);
    $card = $result->num_rows > 0 ? $result->fetch_assoc() : null;
} else {
    echo "Invalid search parameters.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
            width: 100%;
            text-align: center;
        }
        .btn-primary { background: #28a745; color: white; }
        .btn-secondary { background: #ff5a5f; color: white; }
    </style>
</head>
<body>

    <div class="container">
        <h2>Search Result</h2>
        
        <?php if ($card): ?>
            <h3>Available Card</h3>
            <p>Price: <?= $price ?> EGP</p>
            <p>Stock: <?= $card['stock'] ?> left</p>
            <a href="order.php?id=<?= $card['id'] ?>&price=<?= $price ?>" class="btn btn-primary">
                <i class="fas fa-shopping-cart"></i> Buy Now
            </a>
        <?php else: ?>
            <h3>No Card Available</h3>
            <p>You can request this card when available.</p>
            <a href="request.php?day=<?= $day ?>&month=<?= $month ?>&year=<?= $year ?>&category=<?= $category ?>" 
               class="btn btn-secondary">
                <i class="fas fa-clock"></i> Request When Available
            </a>
        <?php endif; ?>
    </div>

</body>
</html>
