<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    // Define a function to check if a number is even
    function isEven($number) {
        return $number % 2 === 0;
    }   
    // Define a function to check if a number is odd
    function isOdd($number) {
        return $number % 2 !== 0;
    }

    // Define a function to check if a number is prime
    function isPrime($number) {
        if ($number <= 1) return false;
        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i === 0) return false;
        }
        return true;
    }

    // Define a function to check if a number is a perfect square
    function isPerfectSquare($number) {
        $sqrt = sqrt($number);
        return $sqrt * $sqrt === $number;
    }


    echo "Is 4 even? " . (isEven(4) ? "Yes" : "No") . "<br>";
    echo "Is 5 odd? " . (isOdd(5) ? "Yes" : "No") . "<br>";     
    echo "Is 7 prime? " . (isPrime(7) ? "Yes" : "No") . "<br>";
    echo "Is 16 a perfect square? " . (isPerfectSquare(16) ? "Yes" : "No") . "<br>";
    echo "Is 20 a perfect square? " . (isPerfectSquare(20) ? "Yes" : "No") . "<br>";
    echo "Is 25 a perfect square? " . (isPerfectSquare(25) ? "Yes" : "No") . "<br>";

    ?>
    <h1>Number Properties</h1>  
</body>
</html>