<?php
session_start();
require __DIR__ . '/../src/db.php';
require __DIR__ . '/../src/helpers.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(400);
    exit('Invalid article ID.');
}

$stmt = $db->prepare('SELECT title_km, title_en, body_km, body_en, created_at
                      FROM articles
                      WHERE id = ? AND published = 1');
$stmt->execute([$id]);
$article = $stmt->fetch();

if (!$article) {
    http_response_code(404);
    exit('Article not found.');
}
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($article['title_km']) ?> | Caution</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main>
    <article>
        <h1><?= e($article['title_km']) ?></h1>
        <?php if ($article['title_en']): ?>
            <h2 class="title-en"><?= e($article['title_en']) ?></h2>
        <?php endif; ?>
        <time><?= e($article['created_at']) ?></time>
        <div class="body-km"><?= nl2br(e($article['body_km'])) ?></div>
        <?php if ($article['body_en']): ?>
            <hr>
            <div class="body-en"><?= nl2br(e($article['body_en'])) ?></div>
        <?php endif; ?>
    </article>
    <p><a href="index.php">← ត្រឡប់ទៅវិញ</a></p>
</main>
<footer>
    <p>Caution - ប្រុងប្រយ័ត្ន | យល់ដឹងមុន ជៀសវាងមុន។</p>
</footer>
</body>
</html>
