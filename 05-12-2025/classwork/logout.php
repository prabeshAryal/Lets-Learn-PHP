<?php
session_start();

echo "Session ID before logout: " . session_id() . "<br>";

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    echo "Session destroyed.<br>";
    echo "Session ID after logout: " . session_id() . "<br>";
}
?>

<form method="post">
    <button type="submit" name="logout">Logout</button>
</form>