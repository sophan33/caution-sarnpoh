<?php
session_start(); 

// If already logged in, send straight to dashboard
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $valid_user = 'admin';
    
    // ⚠️ PASTE YOUR GENERATED HASH BETWEEN THE SINGLE QUOTES BELOW
    $valid_hash = '$2y$12$bZe3oft9eVQ4F.txfIHWieaSXb1GG.qhV7YQ2sU4OkpmkH0zniUqa'; 

    if ($username === $valid_user && password_verify($password, $valid_hash)) {
        $_SESSION['logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Founder Login - Caution</title>
    <style>
        body { font-family: sans-serif; background: #111; color: #fff; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: #222; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.5); width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #444; background: #333; color: #fff; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #d9534f; color: white; border: none; cursor: pointer; font-weight: bold; }
        button:hover { background: #c9302c; }
        .error { color: #d9534f; font-size: 14px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Founder Login</h2>
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>