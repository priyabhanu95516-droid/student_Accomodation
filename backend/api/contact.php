<?php
require_once __DIR__ . '/../config/headers.php';
require_once __DIR__ . '/../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

$fullName = trim($data['fullName'] ?? '');
$email = trim($data['email'] ?? '');
$phone = trim($data['phone'] ?? '');
$subject = trim($data['subject'] ?? '');
$message = trim($data['message'] ?? '');

if (!$fullName || !$email || !$phone || !$subject || !$message) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "All fields are required."]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Invalid email address."]);
    exit;
}

$stmt = $pdo->prepare("INSERT INTO contact_messages (full_name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$fullName, $email, $phone, $subject, $message]);

echo json_encode(["success" => true, "message" => "Your message has been sent successfully."]);
