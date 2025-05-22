<?php
function checkPath($path) {
    if (is_file($path)) {
        echo "This is a file.";
    } elseif (is_dir($path)) {
        echo "This is a folder.";
    } else {
        echo "Path does not exist.";
    }
}

$baseDir = 'folders/';
$pathToCheck = $baseDir . 'notes.txt'; 
checkPath($pathToCheck);
?>