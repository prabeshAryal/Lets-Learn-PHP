<?php
// Define the file name and the content
$baseDir = 'folders/';
$file = 'notes.txt';
$fileName = $baseDir.$file;
$content = "This is my first file created by PHP.";

if (file_put_contents($fileName, $content) !== false) {
    echo "File '$fileName' created successfully with the specified content.";
} else {
    echo "Failed to create the file '$fileName'.";
}
?>