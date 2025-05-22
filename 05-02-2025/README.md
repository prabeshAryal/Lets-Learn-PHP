# May 2, 2025 - Database Connectivity

This directory contains examples and exercises for working with databases in PHP.

## Contents

- `db_connect.php`: Database connection configuration and setup
- `index.php`: Main application file demonstrating database operations

## What You'll Learn

- Setting up database connections in PHP
- Basic database operations
- Error handling for database connections
- Best practices for database security

## Prerequisites

- MySQL or MariaDB database server
- PHP with MySQL extension enabled
- Basic understanding of SQL

## How to Run

1. Make sure your database server is running
2. Update the database credentials in `db_connect.php` if needed
3. Run the application:
   ```bash
   php -S localhost:8000
   ```

## Database Configuration

The `db_connect.php` file contains the database connection settings. Make sure to:
- Use secure credentials
- Keep sensitive information in environment variables
- Follow security best practices

## Learning Objectives

- Understanding database connectivity in PHP
- Implementing secure database connections
- Handling database errors and exceptions
- Writing efficient database queries

## Notes

- Always use prepared statements for database queries
- Implement proper error handling
- Follow security best practices when working with databases
- Keep database credentials secure 