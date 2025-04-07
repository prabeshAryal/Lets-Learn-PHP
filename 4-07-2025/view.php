<?php
// view.php

// Check if parameters are set
$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'Guest';
$language = isset($_GET['language']) ? htmlspecialchars($_GET['language']) : 'N/A';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Build a query string for demonstration
$params = [
    'name' => $name,
    'language' => $language,
    'page' => $page,
];
$queryString = http_build_query($params);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Parameters</title>
</head>
<body>
    <h1>Submitted Information</h1>
    <p>Name: <?php echo $name; ?></p>
    <p>Favorite Language: <?php echo $language; ?></p>
    <p>Page Number: <?php echo $page; ?></p>
    
    <h2>Generated Query String</h2>
    <p><?php echo $queryString; ?></p>

    <h2>Encoded URL Example</h2>
    <p>Encoded Name: <?php echo rawurlencode($name); ?></p>
</body>
</html>