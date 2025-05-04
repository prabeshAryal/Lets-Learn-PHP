<?php
require 'db_connect.php';

$stmt = $pdo->prepare("SELECT * FROM students");
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
    <style>
        table { border-collapse: collapse; width: 50%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Student Records</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Score</th></tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= htmlspecialchars($student['id']) ?></td>
            <td><?= htmlspecialchars($student['name']) ?></td>
            <td><?= htmlspecialchars($student['email']) ?></td>
            <td><?= htmlspecialchars($student['score']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>