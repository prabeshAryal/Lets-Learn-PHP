<?php
session_start();
require_once '../config/database.php';

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Check if ID is provided
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Fetch article to get image URL
$sql = "SELECT image_url FROM news WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $article = mysqli_fetch_assoc($result);
    
    // Delete image if exists
    if (!empty($article['image_url']) && file_exists("../" . $article['image_url'])) {
        unlink("../" . $article['image_url']);
    }
    
    // Delete article
    $sql = "DELETE FROM news WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success_message'] = "Article deleted successfully!";
    } else {
        $_SESSION['error_message'] = "Error deleting article: " . mysqli_error($conn);
    }
} else {
    $_SESSION['error_message'] = "Article not found!";
}

header('Location: index.php');
exit(); 