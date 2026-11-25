<?php
session_start();
require __DIR__ . '/../src/db.php';
require __DIR__ . '/../src/helpers.php';

$stmt = $db->query('SELECT id, title_km, title_en, created_at
                    FROM articles
                    WHERE published = 1
                    ORDER BY created_at DESC');
$articles = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caution - ប្រុងប្រយ័ត្ន</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-header">
    <h1>Caution - ប្រុងប្រយ័ត្ន</h1>
    <p class="tagline">យល់ដឹងមុន ជៀសវាងមុន។</p>
</header>
<main>
<?php if (empty($articles)): ?>
    <p>មិនទាន់មានអត្ថបទនៅឡើយទេ។</p>
<?php else: ?>
    <div class="article-grid">
    <?php foreach ($articles as $a): ?>
        <article class="card">
            <h2><a href="article.php?id=<?= (int)$a['id'] ?>"><?= e($a['title_km']) ?></a></h2>
            <?php if ($a['title_en']): ?>
                <p class="title-en"><?= e($a['title_en']) ?></p>
            <?php endif; ?>
            <time><?= e($a['created_at']) ?></time>
        </article>
    <?php endforeach; ?>
    </div>
<?php endif; ?>
</main>
<footer>
    <p>Caution - ប្រុងប្រយ័ត្ន | យល់ដឹងមុន ជៀសវាងមុន។</p>
</footer>
</body>
</html>
