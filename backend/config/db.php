<?php
// ============================================
// Database connection (PDO + MySQL)
// ============================================

$host = "127.0.0.1";
$port = 3307;
$dbname = "student_accommodation";
$username = "root";      // change if your MySQL user is different
$password = "";          // change if your MySQL has a password

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $e->getMessage()]);
    exit;
}