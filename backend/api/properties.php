<?php
require_once __DIR__ . '/../config/headers.php';
require_once __DIR__ . '/../config/db.php';

$location = trim($_GET['location'] ?? '');

if ($location !== '') {
    $stmt = $pdo->prepare("SELECT id, name, location, rent, rating, image, description FROM properties WHERE location LIKE ? ORDER BY id ASC");
    $stmt->execute(['%' . $location . '%']);
} else {
    $stmt = $pdo->query("SELECT id, name, location, rent, rating, image, description FROM properties ORDER BY id ASC");
}
$properties = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Attach amenities to each property
$amenityStmt = $pdo->prepare("SELECT amenity FROM property_amenities WHERE property_id = ?");
foreach ($properties as &$property) {
    $amenityStmt->execute([$property['id']]);
    $property['amenities'] = $amenityStmt->fetchAll(PDO::FETCH_COLUMN);
}

echo json_encode(["success" => true, "properties" => $properties]);
