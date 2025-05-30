<?php
$host = "localhost"; // اسم السيرفر
$user = "root"; // اسم المستخدم لقاعدة البيانات
$pass = ""; // كلمة المرور (اتركها فارغة إذا كنت تستخدم XAMPP)
$dbname = "card_store"; // اسم قاعدة البيانات

// إنشاء الاتصال
$conn = new mysqli($host, $user, $pass, $dbname);

// التحقق من نجاح الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// تحديد ترميز الاتصال لضمان دعم اللغة العربية
$conn->set_charset("utf8mb4");
?>
