<?php
require __DIR__ . '/db.php'; // Pull in the connection

// Fetch only published articles, newest first
$sql = "SELECT id, title_km, title_en, body_km, body_en, created_at 
        FROM articles 
        WHERE published = 1 
        ORDER BY created_at DESC";

$stmt = $pdo->query($sql); // Run the query
$articles = $stmt->fetchAll(); // Put all results into an array
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caution - ប្រុងប្រយ័ត្ន</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; line-height: 1.6; }
        article { border-bottom: 1px solid #ccc; padding-bottom: 20px; margin-bottom: 20px; }
        .date { color: #666; font-size: 0.9em; }
    </style>
</head>
<body>

    <h1>Caution - ប្រុងប្រយ័ត្ន</h1>

    <?php if (empty($articles)): ?>
        <!-- Show this if the DB is empty -->
        <p>មិនមានអត្ថបទនៅឡើយទេ។ (No articles yet.)</p>
    <?php else: ?>
        <!-- Loop through each row -->
        <?php foreach ($articles as $article): ?>
            <article>
                <h2><?php echo htmlspecialchars($article['title_km']); ?></h2>
                <h3><?php echo htmlspecialchars($article['title_en']); ?></h3>
                
                <p><?php echo nl2br(htmlspecialchars($article['body_km'])); ?></p>
                <p style="color: #555; font-style: italic;"><?php echo nl2br(htmlspecialchars($article['body_en'])); ?></p>
                
                <span class="date"><?php echo $article['created_at']; ?></span>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>

    <footer>
        <p><strong>Caution - ប្រុងប្រយ័ត្ន | យល់ដឹងមុន ជៀសវាងមុន។</strong></p>
    </footer>

</body>
</html>
