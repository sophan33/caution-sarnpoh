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
    <!-- Add this line to link your CSS -->
    <link rel="stylesheet" href="/asset/style.css">
    <link rel="icon" href="/asset/favicon.png" type="image/x-icon">
</head>
<body>

    <header>
        <div class="container">
            <a href="/" class="logo">Caution - ប្រុងប្រយ័ត្ន</a>
        </div>
    </header>

    <main class="container">
        <?php if (empty($articles)): ?>
            <p style="margin-top: 40px; text-align: center;">មិនមានអត្ថបទនៅឡើយទេ។ (No articles yet.)</p>
        <?php else: ?>
            
            <div class="article-grid">
                <?php foreach ($articles as $article): ?>
                    <article>
                        <!-- Khmer Title -->
                        <h2 class="title-km"><?php echo htmlspecialchars($article['title_km']); ?></h2>
                        
                        <!-- English Title -->
                        <h3 class="title-en"><?php echo htmlspecialchars($article['title_en']); ?></h3>
                        
                        <!-- Khmer Body -->
                        <div class="body-km"><?php echo nl2br(htmlspecialchars($article['body_km'])); ?></div>
                        
                        <!-- English Body -->
                        <div class="body-en"><?php echo nl2br(htmlspecialchars($article['body_en'])); ?></div>
                        
                        <!-- Date -->
                        <div class="date"><?php echo $article['created_at']; ?></div>
                    </article>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>
    </main>

    <footer>
        <div class="container">
            <p><strong>Caution - ប្រុងប្រយ័ត្ន | យល់ដឹងមុន ជៀសវាងមុន។</strong></p>
        </div>
    </footer>

</body>
</html>
