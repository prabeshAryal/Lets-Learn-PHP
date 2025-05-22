<!-- Copy "notes.txt" file and create a new one called "backup.txt". -->

<?php 
$baseDir = 'folders/';
$file = 'notes.txt';
$fileName = $baseDir.$file;
$newName = $baseDir."backup.txt";

if (file_exists($fileName)){
   ;

   if (file_put_contents($newName, file_get_contents($fileName)) !== false) {
    echo "File '$newName' created successfully with the specified content.";
} else {
    echo "Failed to create the file '$newName'.";
}}
else {
    echo("File doesn't exist");
}
?>