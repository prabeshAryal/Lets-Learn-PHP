<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
<form method="POST">

<input type="text" name="fileName" placeholder="Enter file name">
    <button type="submit" name="action" value="check">Check</button>
</form>

<?php 
$baseDir = 'folders/'; 

if ($_SERVER['REQUEST_METHOD']=="POST"){

    $fileName = trim($_POST['fileName']);
    $fullFile=$baseDir.$fileName;
    if (is_file($fullFile)){
        echo("File Found");
    }
    else {
        echo("File Not Found");
    }

}

?>

</body>
</html>