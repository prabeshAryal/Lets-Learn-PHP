<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php

// Day 03 - User defined functions
echo "<ol>";
echo "<li>";

// 📝 Task 1: 
echo "<ul>";
echo "<li>";
// 1. Create a functiion that take a salary as an argument, increase it by 10%, and return the new salary without modifying the original variable.
function salarayinc($a){
return $a+(10/100)*$a;
}
echo salarayinc(1000);
echo "</li>";

// 2. Create another functiion that take a salary as a reference and modify the original variable directly by increasing it by 20%.
echo "<li>";

$sal = 1100;
function salarayincD(&$a){
$a = $a + ($a*20)/100;
}
echo "Prev Sal : ".$sal ." | ";
salarayincD($sal);
echo "Increased Sal : ". $sal;
echo "</li>";

echo "</ul>";
echo "</li>";

// 📝 Task 2: Write an arrow function that returns the square of a given number.
echo "<li>";
$num = 2;

$square = fn($x)=>$x*$x;
echo "Square of ". $num. " is " . $square($num);
echo "</li>";


// 📝 Task 3: Write a function that divides two numbers and returns the result.
// The function must take float inputs and return a float.
// Ensure the function does not allow division by zero (can use an if statement).
echo "<li>";

$num1 = 1838;
$num2 = 11;

function divider(float $a,float $b){
    if ($b==0){
        return "Division By Zero is Not Allowed!";
    }
    else {
        return "$a divided by $b is ".$a/$b;
    }
}
echo divider($num1,$num2);
echo "</li>";

// 📝 Task 4: Write a function that takes two arrays as arguments and merges them into one using the spread operator (...)
echo "<li>";
$arr = [1,2,3,4];
$arr2 = [2,4,6,8];
echo "<ul>";
echo "<li>";

echo "[";
foreach ($arr as $number){
    echo " $number,";
}
echo "]";
echo "</li>";

echo "<li>";

echo "[";
foreach ($arr2 as $number){
    echo " $number,";
}
echo "]";
echo "</li>";

function arr_merge($a1, $a2){
    return [...$a1,...$a2];
}

echo "<li>";

$a3= arr_merge($arr,$arr2);
echo "[";
foreach ($a3 as $number){
    echo " $number,";
}
echo "]";
echo "</li>";
echo "</ol>";

echo "</li>";
// 📝 Task 5: Write a function called greet() that generates a greeting message based on a name, a title, and an optional punctuation mark. The function should use named parameters so that when calling it, a user can skip providing the title while still specifying the name and punctuation. By default, the title should be "Mr./Ms.", and the punctuation should be "!". For example, calling greet(name: "Afsana", punctuation: ".") should output "Hello, Mr./Ms. Afsana." since the title parameter is skipped but retains its default value. 
echo "<li>";
function greet($name, $title="Mr./Ms.", $punctuation="!", $gender=null,){
    switch ($gender):
        case "M":
            return "Hello, Mr. $name$punctuation";
            break;
        case "F":
            return "Hello, Mrs. $name$punctuation";
            break;
        default:
            return "Hello, $title $name$punctuation";
    endswitch;
}
echo greet(name: "Prabesh",gender:"M", punctuation:"🙏");
echo "</li>";    

echo "</ol>";

?>
</body>
</html>