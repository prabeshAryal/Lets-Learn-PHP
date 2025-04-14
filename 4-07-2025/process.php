<?php
// process.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $language = htmlspecialchars($_POST['language']);
    $page = (int)$_POST['page'];

    // Redirect to view.php with parameters
    header("Location: view.php?" . http_build_query(['name' => $name, 'language' => $language, 'page' => $page]));
    exit();
}
?>