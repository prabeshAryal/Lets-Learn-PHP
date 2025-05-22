<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['theme_color'] = $_POST['theme_color'];
    $_SESSION['font_size'] = $_POST['font_size'];
    
    header("Location: display_preferences.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Preferences</title>
</head>
<body>
    <h1>Set Your Preferences</h1>
    <form method="post" action="">
        <label for="theme_color">Theme Color:</label>
        <input type="text" id="theme_color" name="theme_color" required><br><br>
        
        <label for="font_size">Font Size:</label>
        <input type="text" id="font_size" name="font_size" required><br><br>
        
        <input type="submit" value="Save Preferences">
    </form>
</body>
</html>
