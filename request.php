<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'] ?? null;
    $category = $_POST['category'];
    
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];

    function generateRequestNumber() {
        return strtoupper(substr(md5(time() . rand()), 0, 6));
    }
    $request_number = generateRequestNumber();

    $stmt = $conn->prepare("INSERT INTO pending_requests (request_number, day, month, year, category, customer_name, customer_phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siiissss", $request_number, $day, $month, $year, $category, $customer_name, $customer_phone);
    $stmt->execute();

    echo "<script>alert('تم إرسال طلبك! كود الطلب: $request_number');</script>";
}

$day = $_GET['day'] ?? '';
$month = $_GET['month'] ?? '';
$year = $_GET['year'] ?? '';
$category = $_GET['category'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a Card</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            max-width: 400px;
            margin: auto;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background: #6a5acd;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>

    <h2>Request a Card</h2>
    <form action="" method="post">
        <input type="hidden" name="day" value="<?= $day ?>">
        <input type="hidden" name="month" value="<?= $month ?>">
        <input type="hidden" name="year" value="<?= $year ?>">
        <input type="hidden" name="category" value="<?= $category ?>">

        <input type="text" name="customer_name" placeholder="Your Name" required>
        <input type="text" name="customer_phone" placeholder="Phone Number" required>
    

        <button type="submit">Submit Request</button>
    </form>

</body>
</html>
