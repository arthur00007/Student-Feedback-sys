# Student Feedback System

A web-based **Student Feedback System** built using PHP, MySQL, JavaScript, HTML, and Bootstrap CSS.

## Tech Stack

* **HTML** — Page structure
* **Bootstrap CSS** — UI styling and responsive design (Dark/Light/Auto mode)
* **JavaScript** — Client-side interactions and validation
* **PHP** — Backend/server-side logic
* **MySQL** — Database

## Requirements

Install the following locally before running the project:

* **PHP 8.0+** (with `pdo_mysql` extension)
* **MySQL 8.0+**
* A web browser
* Git

## Installation & Setup

### 1. Clone the repository

```bash
git clone https://github.com/blezecon/Student-Feedback-sys.git
cd Student-Feedback-sys
```

### 2. Import Database Schema

Make sure MySQL is running, then import the schema:

```bash
mysql -u root < database/schema.sql
```

### 3. Running the Project (Linux / WSL / macOS)

Open a terminal in the project's root directory:

```bash
php -S localhost:8000
```

The application will be accessible at:

**http://localhost:8000**

*(Press `Ctrl + C` in the terminal to stop the server).*

### 4. Creating an Admin Account

Since public registration is only open for Students and Teachers:

1. Open **http://localhost:8000/auth/register.php** in your browser and register an account.
2. In MySQL (terminal or GUI), run this query to promote your account to **Admin**:

```sql
UPDATE users SET role = 'admin', is_verified = 1 WHERE email = 'your_email@gmail.com';
```

3. You can now log into the Admin Portal at **http://localhost:8000/auth/admin_login.php**.

## Notes

* Bootstrap and SVG icons are stored locally in `assets/`, so an internet connection is not required to run the frontend.
* MySQL must be running while using the application.
* PHP's built-in server is intended for local development and testing, not production hosting.
