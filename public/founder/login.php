<?php
session_start();
require __DIR__ . '/../../src/db.php';
require __DIR__ . '/../../src/helpers.php';

// Regenerate: php -r "echo password_hash('YOUR_PASSWORD', PASSWORD_DEFAULT), PHP_EOL;"
const ADMIN_USER = 'admin';
const ADMIN_HASH  = 'PUT_YOUR_BCRYPT_HASH_HERE';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';
    if (hash_equals(ADMIN_USER, $u) && password_verify($p, ADMIN_HASH)) {
        session_regenerate_id(true);
        $_SESSION['founder'] = true;
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Login failed.';
}
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Caution</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<main class="form-page">
    <h1>Founder Login</h1>
    <?php if ($error): ?><p class="error"><?= e($error) ?></p><?php endif; ?>
    <form method="post">
        <?= csrf_field() ?>
        <label>Username <input type="text" name="username" required></label>
        <label>Password <input type="password" name="password" required></label>
        <button type="submit">Login</button>
    </form>
</main>
</body>
</html>
