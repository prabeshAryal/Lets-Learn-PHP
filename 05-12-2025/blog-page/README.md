# Simple PHP Blog Page with Admin Panel

## Assignment Overview

This project is a solution to the following assignment:

> **You are asked to create a simple blog page with an admin panel. The admin will be able to add news, and the news will be stored in a database. The added news will be displayed on the blog page.**
>
> **Requirements:**
> - **Admin Panel:** The admin will have access to a form where they can add news. The admin can enter the following details for a news item: title, content, date of publication. The form should save the data in the database.
> - **Database:** Set up a simple database using MySQL. A database table called `news` with at least the following columns: id (primary key), title, content, published date. Use PHP to handle admin panel's functionality.
> - **Frontend:** The frontend will display all news articles. Each article will show the title, content, and date of publication. The news articles should be displayed in a list format on the homepage. Each news article can be clicked to view more details.
> 
> **Additional Notes:** The focus is on creating the basic functionality of the admin panel and the blog page. You do not need to focus on design or complex features for this task, just the essential functionality.

---

## Features

- **Admin Panel:**
  - Secure login for admin (optional, but included for basic security)
  - Form to add news articles (title, content, date of publication)
  - News articles are saved to the database

- **Database:**
  - MySQL database with a `news` table:
    - `id` (primary key, auto-increment)
    - `title` (string)
    - `content` (text)
    - `published_date` (datetime)

- **Frontend:**
  - Homepage displays a list of all news articles
  - Each article shows its title, content, and date of publication
  - Clicking an article shows its full details on a separate page

## Project Structure

- `index.php` — Homepage listing all news articles
- `article.php` — Detailed view for a single news article
- `admin/` — Admin panel for adding news
- `config/` — Database configuration
- `create_admin.php` — (Optional) Script to create an admin user

## Setup & Usage

1. **Requirements:**
   - PHP 7.4 or higher
   - MySQL or MariaDB
   - Web server (Apache/Nginx) or PHP's built-in server

2. **Clone the repository:**
   ```bash
   git clone <repo-url>
   cd <repo-root>/05-12-2025/blog-page
   ```

3. **Database Setup:**
   - The first time you run the app, `config/database.php` will automatically create the database and required tables if they do not exist.
   - Update database credentials in `config/database.php` if needed.

4. **Create an Admin User (Optional):**
   - Visit `create_admin.php` in your browser to create your first admin account.

5. **Run the Application:**
   - Start PHP's built-in server:
     ```bash
     php -S localhost:8000
     ```
   - Open your browser and go to `http://localhost:8000` to view the blog.
   - Go to `http://localhost:8000/admin/login.php` to access the admin panel.

## Learning Objectives

- How to build a simple CRUD (Create, Read, Update, Delete) application in PHP
- How to connect PHP to a MySQL database
- How to structure a basic PHP project
- How to separate admin and public functionality

## Possible Extensions (Not required by assignment)

- Add image upload for articles
- Add categories or tags
- Add user registration and comments
- Improve security (prepared statements, CSRF protection)
- Enhance the UI with CSS frameworks

## Notes

- This project is intentionally simple and focused on core functionality as per the assignment.
- You are encouraged to experiment and extend the project after meeting the basic requirements. 