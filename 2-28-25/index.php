<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Exercises</title>
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            padding: 20px;
        }
        .table-container {
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse; 
            background: white;
            margin: 0 auto; 
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center; 
        }
        th {
            background-color: #f2f2f2;
        }
        .even {
            background-color: pink;
            width: 100%;
            margin: auto;
            padding: 5px; 
            text-align: center; 
        }
        .odd {
            background-color: green;
            width: 100%;
            margin: auto;
            padding: 5px; 
            text-align: center; 
            color: white; 
        }
        ol {
            list-style-type: decimal; 
        }
        li {
            padding: 5px;
            margin-bottom: 5px; 
        }
        .weekend {
            background-color: #dddd22; 
        }

    </style>
</head>
<body>
    <h1>PHP Exercises</h1>

    <h2>1. Star Pyramid</h2>
    <?php
    /* 1. Generate a pyramid of * (stars) using a nested for loop. The height of the pyramid is stored in $height variable . */

    $height = 5;
echo "<div style='width:100%; margin:auto; text-align:center; border:solid 1px black;'>";
    for ($a=1; $a<=$height; $a++){
        echo str_repeat("&nbsp",$height-$a); 
        echo str_repeat("*",$a);

        echo("<br>");
    }
    echo "</div>"

    ?>

    <h2>2. Multiplication Tables</h2>
    <?php
    // 2. Create a multiplication table from 1 to 5 and display each table inside a div element with a unique background color.

    echo "<div class='grid-container'>";

    for ($i=1; $i<=5;$i++){
        $bgcolor = sprintf("%02x%02x%02x", $i * 40, 255 - ($i * 30), 200 + ($i * 10));
        echo "<div class='table-container' style='background-color:#$bgcolor;'>"; 
        echo "<table border='1' style='background-color:#$bgcolor'>"; 
        echo "<tr><th>Table For $i</th></tr>";

        for ($j=1; $j<=10; $j++){
            $result = $i*$j;
            echo "<tr><td>$i × $j = $result</td></tr>";
        }
        echo "</table>";

        echo "</div>";
    }
    echo "</div>";
    ?>

    <h2>3. Even/Odd Numbers with Colored Backgrounds</h2>
    <?php
    //3. Generate a list of numbers from 1 to 10. If a number is even, display it inside a <div> with a pink background. If a number is odd, display it inside a <div> with a green background.

    for($i=1; $i<=10;$i++){
        if ($i%2==0){
            echo "<div class='even'>$i</div>" ;
        }
        else {
            echo "<div class='odd'>$i</div>"; 
        }
    }
    ?>

    <h2>4. Number, Square, and Cube Table</h2>
    <?php
    //4. Create an HTML <table> displaying numbers from 1 to 10. Each row should contain the number itself,its square and its cube.
    echo "<table border='1'>"; 
    echo "<tr><th>Number</th><th>Square</th><th>Cube</th></tr>";
    for($i=1; $i<=10;$i++){
        $square= $i*$i;
        $cube=$i*$i*$i;
        echo "<tr><td>$i</td><td>$square</td><td>$cube</td></tr>";
    }

    echo "</table>";
    ?>

    <h2>5. Days of the Week List</h2>
    <?php
    //5. Print the days of the week inside a ordered list . If the day is Saturday or Sunday, display it with a different background.

    $days = [1 => "Sunday", 2 => "Monday", 3 => "Tuesday", 4 => "Wednesday", 5 => "Thursday", 6 => "Friday", 7 => "Saturday"];
    echo "<ol>";
    for ($i = 1; $i <= 7; $i++) {
        $dayName = $days[$i];
        $isWeekend = ($i == 1 || $i == 7);
        $class = $isWeekend ? 'weekend' : '';

        echo "<li class='$class'>" . $dayName . "</li>"; 
    }
    echo "</ol>";
    ?>

    <h2>6. Student Results</h2>
    <?php
    //6. Use the array below to generate a list of students and their results. If a student scores 60 or above, mark them as 'Passed'. Otherwise, mark them as 'Failed'."

    $students = [
        ["Alice", 85],
        ["Bob", 45],
        ["Charlie", 78],
        ["David", 59],
        ["Emma", 92],
        ["Frank", 60],
    ];

    echo "<table>
    <tr>
    <th>Name</th>
    <th>Marks</th>
    <th>Remarks</th>
    </tr>";
    foreach ($students as $student){
        $name = $student[0];
        $marks= $student[1];
        $remarks = $marks>=60?"Passed":"Failed";
        echo "<tr>
        <td>$name</td>
        <td>$marks</td>
        <td>$remarks</td>
        </tr>";
    }
    echo"</table>";
    ?>

    <h2>7. Employee Salaries and Bonuses</h2>
    <?php
    //7.You have an array of employees. If an employee’s salary is $3000 or more, they receive a 10% bonus; otherwise, they receive a 5% bonus. Display a list of employees with their total salary, including the bonus.

    $employees = [
        ["Alice", 2700],
        ["Bob", 4500],
        ["Charlie", 780],
        ["David", 5190],
        ["Emma", 1192],
        ["Frank", 3460],
    ];

    echo "<table>
    <tr>
    <th>Name</th>
    <th>Salary</th>
    <th>Bonus Percentage</th>
    <th>Total Salary</th>
    </tr>";
    foreach ($employees as $employee){
        $name = $employee[0];
        $salary= $employee[1];
        $bonus= $salary>=3000?10:5;
        $total = $salary+ $salary* ($bonus/100);
        echo "<tr>
        <td>$name</td>
        <td>$salary</td>
        <td>$bonus%</td>
        <td>$total</td>
        </tr>";
    }
    echo"</table>";
    ?>

</body>
</html>