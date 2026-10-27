<?php
require_once __DIR__ . '/../config/headers.php';
require_once __DIR__ . '/../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

$email = trim($data['email'] ?? '');
$password = $data['password'] ?? '';

if (!$email || !$password) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Email and password are required."]);
    exit;
}

$stmt = $pdo->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['password'])) {
    http_response_code(401);
    echo json_encode(["success" => false, "message" => "Invalid email or password."]);
    exit;
}

// Start session
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_email'] = $user['email'];

echo json_encode([
    "success" => true,
    "message" => "Login successful.",
    "user" => [
        "id" => $user['id'],
        "name" => $user['name'],
        "email" => $user['email']
    ]
]);
