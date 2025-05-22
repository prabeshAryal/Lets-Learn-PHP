<?php 
$baseDir = 'folders/';
$file = 'notes.txt';
$fileName = $baseDir.$file;

if (file_exists($fileName)){
    echo("<h1 align='center'>".$file."</h1>");
echo("<pre>".file_get_contents($fileName)."</pre>");
}
else {
    echo("File doesn't exist");
}
?>