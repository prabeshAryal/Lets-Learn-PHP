<!-- Write a PHP script that implements a "remember me" feature:
a) Create a login form with fields for username, password, and a "remember me" checkbox. (2 points)
b) If the user logs in successfully and selects the "remember me" option, set a cookie to store the username. (2 points)
c) Set the cookie to expire after 30 days. (2 points)
d) If the cookie exists and is valid, display the message: “[Username] logged in”. (2 points)
e) If the cookie does not exist, print the message: “Username does not exist”. (2 points) -->


<?php
$cookie_name='remember_me';

if (isset($_COOKIE[$cookie_name])) {
    $username=htmlspecialchars($_COOKIE[$cookie_name]);
    echo "$username logged in";
} 
elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($_POST['remember_me'])) {
        $expiry = time() + (30 * 24 * 60 * 60); // 30 days
        setcookie($cookie_name, $username, $expiry, "/");
        echo "Login successful. Cookie set for 30 days.";
    } else {
        echo "Login successful. Cookie not set.";
    }
}
else {
    displayloginForm();
}
  

function displayloginForm() {
    echo '<form action="" method="POST">

    echo <label for="#name">Username:</label>
    <input type="text" id="name" name="username" />
    <label for="#pass">Password:</label>
    
    <input type="password" id="pass" name="password" />
    <p><input type="checkbox" name="remember_me">RememberMe</p>
    <p><input type="submit" value="Login"></p>
    
    </form>';
}
?>

