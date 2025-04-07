<?php
// Initialize variables to hold form data
$name = '';
$password = '';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the parameters
    $name = htmlspecialchars($_POST['name']);
    $password = htmlspecialchars($_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Example</title>
</head>
<body>
    <h1>Form Submission</h1>
    <form action="" method="post">
        <input type="text" name="name" id="name" placeholder="Enter your name" required value="<?php echo $name; ?>" />
        <input type="password" name="password" placeholder="Enter your password" required />
        <button type="submit">Submit</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <h2>Captured Parameters</h2>
        <p>Name: <?php echo $name; ?></p>
        <p>Password: <?php echo $password; ?></p>
    <?php endif; ?>
</body>
</html>