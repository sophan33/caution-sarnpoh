<?php
session_start();
// The Bouncer
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Write New Article</title>
    <style>
        body { font-family: sans-serif; padding: 40px; background: #f4f4f4; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type="text"], textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-family: inherit; }
        textarea { height: 150px; resize: vertical; }
        button { padding: 10px 20px; background: #5cb85c; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background: #4cae4c; }
        .back { text-decoration: none; color: #0275d8; display: inline-block; margin-bottom: 20px; }
    </style>
</head>
<body>

    <a href="dashboard.php" class="back">← Back to Dashboard</a>
    <h1>Write New Article</h1>

    <!-- action="save_article.php" means this form sends data to that file -->
    <form action="save_article.php" method="POST">
        
        <div class="form-group">
            <label>Title (Khmer)</label>
            <input type="text" name="title_km" required>
        </div>

        <div class="form-group">
            <label>Title (English)</label>
            <input type="text" name="title_en" required>
        </div>

        <div class="form-group">
            <label>Body (Khmer)</label>
            <textarea name="body_km" required></textarea>
        </div>

        <div class="form-group">
            <label>Body (English)</label>
            <textarea name="body_en" required></textarea>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="published" value="1" checked> 
                Publish immediately (uncheck to save as draft)
            </label>
        </div>

        <button type="submit">Save Article</button>

    </form>

</body>
</html>