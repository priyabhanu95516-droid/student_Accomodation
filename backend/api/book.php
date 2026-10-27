<?php
require_once __DIR__ . '/../config/headers.php';
require_once __DIR__ . '/../config/db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["success" => false, "message" => "Please login to book a property."]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$propertyId = $data['propertyId'] ?? null;

if (!$propertyId || !is_numeric($propertyId)) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Valid property id is required."]);
    exit;
}

$stmt = $pdo->prepare("SELECT id FROM properties WHERE id = ?");
$stmt->execute([$propertyId]);
if (!$stmt->fetch()) {
    http_response_code(404);
    echo json_encode(["success" => false, "message" => "Property not found."]);
    exit;
}

$stmt = $pdo->prepare("INSERT INTO bookings (user_id, property_id, status) VALUES (?, ?, 'pending')");
$stmt->execute([$_SESSION['user_id'], $propertyId]);

echo json_encode(["success" => true, "message" => "Booking request submitted successfully."]);
