<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

$folder = opendir("files");
$files = [];
while(($currentFile = readdir($folder)) !== false) {

if($currentFile === '.' || $currentFile === "..") { continue; }

$files[] = $currentFile; }

echo ($files[0]);

closedir($folder);
?>
</body>
</html>