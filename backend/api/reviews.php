<?php
require_once __DIR__ . '/../config/headers.php';
require_once __DIR__ . '/../config/db.php';

$propertyId = $_GET['property_id'] ?? null;

if (!$propertyId || !is_numeric($propertyId)) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Valid property_id is required."]);
    exit;
}

$stmt = $pdo->prepare("SELECT reviewer_name, rating, comment FROM reviews WHERE property_id = ? ORDER BY created_at DESC");
$stmt->execute([$propertyId]);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["success" => true, "reviews" => $reviews]);
