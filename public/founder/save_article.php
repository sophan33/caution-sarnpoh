<?php
session_start();

// 1. The Bouncer: Kick out anyone not logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

// 2. Make sure the form was actually submitted via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: dashboard.php');
    exit;
}

// 3. Bring in the database connection
require_once __DIR__ . '/../db.php'; 

// 4. Grab the data from the form
$title_km = $_POST['title_km'] ?? '';
$title_en = $_POST['title_en'] ?? '';
$body_km  = $_POST['body_km'] ?? '';
$body_en  = $_POST['body_en'] ?? '';
// If the checkbox is checked, it sends '1'. If not, it sends nothing, so we default to '0'.
$published = isset($_POST['published']) ? 1 : 0;

// 5. The Prepared Statement (The Shield)
$sql = "INSERT INTO articles (title_km, title_en, body_km, body_en, published) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);

// 6. Execute the query, passing the data in the exact order of the ?
try {
    $stmt->execute([$title_km, $title_en, $body_km, $body_en, $published]);
    
    // Success! Send them back to the dashboard
    header('Location: dashboard.php?success=1');
    exit;

} catch (PDOException $e) {
    // If it fails (e.g., database is down), show the error
    die("Error saving article: " . $e->getMessage());
}