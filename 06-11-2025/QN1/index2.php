<?php
$username="root";
$password="";
$database="courses";

try{
$pdo = new PDO("mysql:host=localhost",$username,$password);

upDateGradeSTD($id, $name, $grade){

}

}
catch(PDOException $e) {
echo $e;
}

?>