<?php
require __DIR__ . '/auth.php';
require __DIR__ . '/../../src/db.php';
require __DIR__ . '/../../src/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('POST only.');
}

csrf_check();

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) { http_response_code(400); exit('Invalid ID.'); }

$stmt = $db->prepare('DELETE FROM articles WHERE id = ?');
$stmt->execute([$id]);

header('Location: dashboard.php');
exit;
