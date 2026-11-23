<?php
session_start();

// THE BOUNCER: If not logged in, kick them back to the login page
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Founder Dashboard</title>
    <style>
        body { font-family: sans-serif; padding: 40px; background: #f4f4f4; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn { padding: 10px 15px; background: #0275d8; color: white; text-decoration: none; border-radius: 4px; }
        .logout { background: #d9534f; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Founder Dashboard</h1>
        <a href="logout.php" class="btn logout">Logout</a>
    </div>

    <p>Welcome to the vault. Here is where you will write and manage your articles.</p>
    <a href="new_article.php" class="btn" style="background: #5cb85c; margin-bottom: 20px; display: inline-block;">+ Write New Article</a>
    <hr>
    <h3>Your Articles (Coming Soon)</h3>
    <p>In the next step, we will connect this to the database to list all your drafts and published posts.</p>

</body>
</html>
