<?php
require __DIR__ . '/auth.php';
require __DIR__ . '/../../src/db.php';
require __DIR__ . '/../../src/helpers.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();

$title_km  = trim($_POST['title_km'] ?? '');
    $title_en  = trim($_POST['title_en'] ?? '') ?: null;
    $body_km   = trim($_POST['body_km'] ?? '');
    $body_en   = trim($_POST['body_en'] ?? '') ?: null;
    $published = isset($_POST['published']) ? 1 : 0;

if ($title_km === '' || $body_km === '') {
        $errors[] = 'Khmer title and body are required.';
    }

if (!$errors) {
        $stmt = $db->prepare('INSERT INTO articles
            (title_km, title_en, body_km, body_en, published)
            VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$title_km, $title_en, $body_km, $body_en, $published]);
        header('Location: dashboard.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Article | Caution</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<main class="form-page">
    <h1>Post អត្ថបទថ្មី</h1>
    <?php foreach ($errors as $err): ?><p class="error"><?= e($err) ?></p><?php endforeach; ?>
    <form method="post">
        <?= csrf_field() ?>
        <label>Title (Khmer) <input type="text" name="title_km" required></label>
        <label>Title (English) <input type="text" name="title_en"></label>
        <label>Body (Khmer) <textarea name="body_km" rows="10" required></textarea></label>
        <label>Body (English) <textarea name="body_en" rows="10"></textarea></label>
        <label class="checkbox"><input type="checkbox" name="published"> Publish immediately</label>
        <button type="submit">Save</button>
        <a href="dashboard.php">Cancel</a>
    </form>
</main>
</body>
</html>
