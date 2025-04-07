<?php
// index.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Management Project</title>
</head>
<body>
    <h1>Submit Your Information</h1>
    <form action="view.php" method="get">
        <input type="text" name="name" placeholder="Enter your name" required />
        <input type="text" name="language" placeholder="Enter your favorite programming language" required />
        <input type="number" name="page" placeholder="Enter page number" required />
        <button type="submit">Submit</button>
    </form>
</body>
</html>