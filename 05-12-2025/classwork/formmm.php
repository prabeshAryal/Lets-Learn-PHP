<?php
session_start();

if (isset($_SESSION['username'])) {
    echo "Welcome, " . $_SESSION['username'];
    exit();
}

$login_error = "";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'demo' && $password === 'password') {
        $_SESSION['username'] = $username;
        header("Location: " . $_SERVER['PHP_SELF']); 
        exit();
    } else {
        $login_error = "Invalid username or password.";
    }
}
?>

<form method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <button type="submit">Login</button>
</form>

<?php if ($login_error): ?>
    <p style="color: red;"><?php echo $login_error; ?></p>
<?php endif; ?>