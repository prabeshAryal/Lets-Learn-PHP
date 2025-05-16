# Simple PHP Login System

This project is a basic PHP login/logout system with session and cookie support.

## Features
- Login form with username, password, and "Remember Me" checkbox
- Session-based authentication
- "Remember Me" stores username in a cookie
- Access to `index.php` is restricted to logged-in users
- Logout button destroys the session and redirects to login

## Usage
1. Open `login.php` in your browser.
2. Use the following credentials:
   - **Username:** admin
   - **Password:** password
3. Check "Remember Me" to save your username in a cookie.
4. After login, you'll be redirected to the main page (`index.php`).
5. Use the logout button to end your session.

## Files
- `login.php` — Login form and authentication logic
- `index.php` — Main page (protected)
- `logout.php` — Logs out and redirects to login
