<?php 
$baseDir = 'folders/';
$file = 'old_notes.txt';
$fileName = $baseDir.$file;

if (file_exists($fileName)){
    if (unlink($fileName)) {
        echo "Successfully deleted '$file'.";
    } else {
        echo "Failed to delete '$file'.";
    }
  }
else {
    echo("File doesn't exist");
}
?>