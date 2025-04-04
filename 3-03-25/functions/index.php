<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            text-align:center;
            width: 100%;
            margin:auto;
            margin-top:50vh;
        }
    </style>
</head>
<body>
    <?php 
    
    $hehe = 1;
    $haha =2 ;

    function sum($a,$b=0){
        return $a+$b;
    }

echo sum($hehe)."<br>";


// Named Prameters
 function createUser($name, $email, $role = "user") {
    echo "Name: $name, Email: $email, Role: $role <br>";
 }
 createUser("Əfsanə", "", "admin");
createUser(email:"hehe@yahoo.com",name:"Prabesh",role:"student");

$a = 69;
$b = 36;
echo $a."|".$b . "====>";  // Outputs: 69|36

function swap(&$x, &$y) {
    $temp = $x; 
    $x = $y;
    $y = $temp;
}

swap($a,$b);
echo $a."|".$b . "<br>";  // Outputs: 36|69


$p =12;
$a = 15; //gives error when passed string
function addNumbers(int $a, int $b): int {
    return $a + $b;
}

echo addNumbers($p,$a);


echo "<br>";
// Spread Operators
function ssum(...$numbers) {
    foreach ($numbers as $number){
echo $number . "<br>";
    }
    return array_sum($numbers);
 }
 echo ssum(1, 2, 3, 4, 5,6,7,8,9,10); // Output: 15


    ?> 



</body>
</html>