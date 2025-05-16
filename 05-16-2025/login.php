<?php
session_start();
// If already logged in, redirect to main page
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: index.php');
    exit();
}

// Hardcoded credentials for demonstration
$valid_username = 'admin';
$valid_password = 'password';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['logged_in'] = true;
        if ($remember) {
            setcookie('remembered_username', $username, time() + (86400 * 30), "/"); // 30 days
        } else {
            setcookie('remembered_username', '', time() - 3600, "/");
        }
        header('Location: index.php');
        exit();
    } else {
        $error = 'Invalid username or password.';
    }
}
$remembered_username = $_COOKIE['remembered_username'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label>Username: <input type="text" name="username" value="<?= htmlspecialchars($remembered_username) ?>" required></label><br><br>
        <label>Password: <input type="password" name="password" required></label><br><br>
        <label><input type="checkbox" name="remember" <?= $remembered_username ? 'checked' : '' ?>> Remember Me</label><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
