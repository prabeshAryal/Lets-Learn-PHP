<?php
//COnnect to database 
// Write a PHP script that connects to a MySQL database using PDO. The database should use the following parameters: host is localhost, database name is courses, username is root, and password is root1234. After establishing the connection, Write a PHP function called updateStudentGrade that updates a student's grade in math course. The function should take parameters for the student ID, course name, and new grade. Use prepared statements and return true if the update was successful or false if not.



$username="root";
$password="";
$database="courses";

$host="localhost";
try {
    // Connect without specifying the database
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if database exists, if not, create it
    $stmt = $pdo->query("SHOW DATABASES LIKE '$database'");
    if ($stmt->rowCount() == 0) {
        $pdo->exec("CREATE DATABASE `$database`");
        echo "Database '$database' created.<br>";
    }

    // Now connect to the database
    $pdo->exec("USE `$database`");
    echo "Connected successfully to the database.<br>";

    function updateStudentGrade($pdo, $studentId, $courseName, $newGrade) {
        $sql = "UPDATE grades SET grade = :newGrade WHERE student_id = :studentId AND course_name = :courseName";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':newGrade', $newGrade);
        $stmt->bindParam(':studentId', $studentId);
        $stmt->bindParam(':courseName', $courseName);
        return $stmt->execute();
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}



?>