<?php
session_start(); 
$theme_color = isset($_SESSION['theme_color']) ? $_SESSION['theme_color'] : 'Not set';
$font_size = isset($_SESSION['font_size']) ? $_SESSION['font_size'] : 'Not set';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Preferences</title>
    <style>
        body {
            background-color: <?php echo htmlspecialchars($theme_color); ?>;
            font-size: <?php echo htmlspecialchars($font_size); ?> !important;
        }
    </style>
</head>
<body>
    <h1>Your Preferences</h1>
    <p><strong>Theme Color:</strong> <?php echo htmlspecialchars($theme_color); ?></p>
    <p><strong>Font Size:</strong> <?php echo htmlspecialchars($font_size); ?></p>
    
    <a href="index.php">Change Preferences</a>
</body>
</html>
