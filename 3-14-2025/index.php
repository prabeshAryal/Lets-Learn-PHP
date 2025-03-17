<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
echo "<ol><li>";
    echo  "<ul>";
        echo "<li>". date("Y-m-d")."</li>" ;
        echo "<li>" .time()."</li>" ;
        echo "<li>". date("Y-m-d",strtotime("next Monday")) ."</li>" ;
        echo "<li>". date("l", strtotime("2025-12-31")) ."</li>" ;
        echo "<li>". date("Y-m-d",strtotime("+7 days")) ."</li>" ;
    echo  "</ul>";
echo "</li>";

echo "<li>";
    echo  "<ul>";
        $now = new DateTime();  
        $futureDate = new DateTime("2026-01-01");
        $diff = $now->diff($futureDate);
        $totalDays = $diff->days;
        echo "<li>$totalDays days left</li>";
        echo "<li>" .date("Y-m-d",1600000000)."</li>" ;
        echo "<li>". date("Y-m-d",strtotime("last friday of this month")) ."</li>" ;
    echo  "</ul>";
echo "</li>";

echo "<li>";
function Weekend($date){
$dayOfWeek = date("w",strtotime($date));
 if ($dayOfWeek == 0 || $dayOfWeek == 6) {
        return true; // It's a weekend
    } else {
        return false; // It's not a weekend
    }
}

echo Weekend("2025-03-14")? "Weekend" : "Working Day";
echo "</li>";

    echo "</ol>";
?>

</body>
</html>