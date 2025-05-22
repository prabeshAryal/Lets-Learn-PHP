<!-- Copy "notes.txt" file and create a new one called "backup.txt". -->

<?php 
$baseDir = 'folders/';
$file = 'backup.txt';
$fileName = $baseDir.$file;
$new="old_notes.txt";
$newName=$baseDir.$new;

if (file_exists($fileName)){
   if (rename($fileName,$newName)!== false){
       echo("Sucessful rename");
   }
   else {
       echo("Failed renaming");
   };
  }
else {
    echo("File doesn't exist");
}
?>