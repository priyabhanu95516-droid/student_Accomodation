<?php
require_once __DIR__ . '/../config/headers.php';
require_once __DIR__ . '/../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

$name = trim($data['name'] ?? '');
$email = trim($data['email'] ?? '');
$password = $data['password'] ?? '';
$confirmPassword = $data['confirmPassword'] ?? '';

if (!$name || !$email || !$password) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "All fields are required."]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Invalid email address."]);
    exit;
}

if (strlen($password) < 6) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Password must be at least 6 characters."]);
    exit;
}

if ($confirmPassword !== '' && $password !== $confirmPassword) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Passwords do not match."]);
    exit;
}

// Check if email already exists
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    http_response_code(409);
    echo json_encode(["success" => false, "message" => "Email already registered."]);
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->execute([$name, $email, $hashedPassword]);

echo json_encode(["success" => true, "message" => "Account created successfully. Please login."]);
