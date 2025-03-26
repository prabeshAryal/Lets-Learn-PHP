<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

$hello = [1,2,3,4];


$prabesh[10] = "prabesh";

var_dump($hello);
var_dump($prabesh);
echo "<br>";


$person = [
    'name' => 'John Doe',
    'age' => 30,
    'city' => 'New York'
];

echo $person['name']; // Output: John Doe
echo $person['age'];  // Output: 30

echo "<br>";
$movies = [
    "Inception" => ["genre" => "Sci-Fi", "rating" => 8.8],
    "Interstellar" => ["genre" => "Sci-Fi", "rating" => 8.7],
    "The Dark Knight" => ["genre" => "Action", "rating" => 9.0]
];

echo $movies["Inception"]["genre"]; // Output: Sci-Fi
echo "<br>";


$fruits = ['Bananas', 'Cantaloupes'];
array_unshift($fruits, 'Apples', 'Avocado');
print_r($fruits); // Output: Array ( [0] => Apples [1] => Avocado [2] => Bananas [3] => Cantaloupes )

echo "<br>";

$person = ['name' => 'John', 'age' => 30, 'city' => 'New York'];

foreach ($person as $key => $value) {
    echo "Key: " . $key . ", Value: " . $value . "<br>";
}
// Output:
// Key: name, Value: John
// Key: age, Value: 30
// Key: city, Value: New York


$numbers = [10, 5, 20, 1];
echo min($numbers); // Output: 1
echo max($numbers); // Output: 20

$strings = ['apple', 'banana', 'cherry'];
echo min($strings); // Output: apple
echo max($strings); // Output: cherry

$mixed = [10, 'apple', 5, 'banana'];
echo min($mixed); // Output: 5
echo max($mixed); // Output: banana

?>
    
</body>
</html>