<?php
require __DIR__ . '/auth.php';
require __DIR__ . '/../../src/db.php';
require __DIR__ . '/../../src/helpers.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { http_response_code(400); exit('Invalid ID.'); }

$stmt = $db->prepare('SELECT * FROM articles WHERE id = ?');
$stmt->execute([$id]);
$article = $stmt->fetch();
if (!$article) { http_response_code(404); exit('Not found.'); }

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
        $stmt = $db->prepare('UPDATE articles
            SET title_km = ?, title_en = ?, body_km = ?, body_en = ?, published = ?
            WHERE id = ?');
        $stmt->execute([$title_km, $title_en, $body_km, $body_en, $published, $id]);
        header('Location: dashboard.php');
        exit;
    }
    $article = array_merge($article, [
        'title_km' => $title_km, 'title_en' => $title_en,
        'body_km' => $body_km, 'body_en' => $body_en,
        'published' => $published,
    ]);
}
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit | Caution</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<main class="form-page">
    <h1>Edit អត្ថបទ</h1>
    <?php foreach ($errors as $err): ?><p class="error"><?= e($err) ?></p><?php endforeach; ?>
    <form method="post">
        <?= csrf_field() ?>
        <label>Title (Khmer) <input type="text" name="title_km"
            value="<?= e($article['title_km']) ?>" required></label>
        <label>Title (English) <input type="text" name="title_en"
            value="<?= e($article['title_en'] ?? '') ?>"></label>
        <label>Body (Khmer) <textarea name="body_km" rows="10" required><?= e($article['body_km']) ?></textarea></label>
        <label>Body (English) <textarea name="body_en" rows="10"><?= e($article['body_en'] ?? '') ?></textarea></label>
        <label class="checkbox"><input type="checkbox" name="published"
            <?= $article['published'] ? 'checked' : '' ?>> Published</label>
        <button type="submit">Update</button>
        <a href="dashboard.php">Cancel</a>
    </form>
</main>
</body>
</html>
