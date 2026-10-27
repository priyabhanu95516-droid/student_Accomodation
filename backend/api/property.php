<?php
require_once __DIR__ . '/../config/headers.php';
require_once __DIR__ . '/../config/db.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Valid property id is required."]);
    exit;
}

$stmt = $pdo->prepare("SELECT id, name, location, rent, rating, image, description FROM properties WHERE id = ?");
$stmt->execute([$id]);
$property = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$property) {
    http_response_code(404);
    echo json_encode(["success" => false, "message" => "Property not found."]);
    exit;
}

$amenityStmt = $pdo->prepare("SELECT amenity FROM property_amenities WHERE property_id = ?");
$amenityStmt->execute([$id]);
$property['amenities'] = $amenityStmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode(["success" => true, "property" => $property]);
