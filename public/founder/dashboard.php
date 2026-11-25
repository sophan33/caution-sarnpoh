<?php
require __DIR__ . '/auth.php';
require __DIR__ . '/../../src/db.php';
require __DIR__ . '/../../src/helpers.php';

$articles = $db->query('SELECT id, title_km, published, created_at
                        FROM articles
                        ORDER BY created_at DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Caution</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<main>
    <h1>Dashboard</h1>
    <p>
        <a href="new.php">+ Post អត្ថបទថ្មី</a> |
        <a href="../index.php">View site</a> |
        <a href="logout.php">Logout</a>
    </p>

<?php if (empty($articles)): ?>
        <p>No articles yet.</p>
    <?php else: ?>
        <table class="admin-table">
            <tr><th>ID</th><th>Title</th><th>Status</th><th>Created</th><th>Actions</th></tr>
            <?php foreach ($articles as $a): ?>
            <tr>
                <td><?= (int)$a['id'] ?></td>
                <td><?= e($a['title_km']) ?></td>
                <td><?= $a['published'] ? 'Published' : 'Draft' ?></td>
                <td><?= e($a['created_at']) ?></td>
                <td class="actions">
                    <a href="edit.php?id=<?= (int)$a['id'] ?>">Edit</a>
                    <form method="post" action="delete.php" class="inline-form"
                          onsubmit="return confirm('Delete permanently?');">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" value="<?= (int)$a['id'] ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</main>
</body>
</html>
