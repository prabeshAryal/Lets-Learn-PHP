<?php
$baseDir = 'folders/';
$file = 'notes.txt';
$fileName = $baseDir . $file;

if (file_exists($fileName)) {
    $lastModified = date("F d, Y H:i:s", filemtime($fileName));
    $fileSize = filesize($fileName);

    echo "<h2>File Information for '$file':</h2>";
    echo "<p>Last Modified: $lastModified</p>";
    echo "<p>File Size: " . $fileSize . " bytes</p>";
} else {
    echo "File '$file' does not exist.";
}
?>