<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <script src="./fiveserver.config.js"></script> -->
</head>
<body>
    <?php
$isMeStudent = true;
if ($isMeStudent === true) {
    echo "<h1>I am a student</h1>";
} 
elseif (!is_bool($isMeStudent)) { 
    echo "<h1>Wrong Input</h1>";
} 
else {
    echo "<h1>I am not a student</h1>";
}
?>
</body>
</html>
