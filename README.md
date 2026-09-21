# Student Feedback System

A web-based **Student Feedback System** built using PHP, MySQL, JavaScript, HTML, and Bootstrap CSS.

## Tech Stack

* **HTML** — Page structure
* **Bootstrap CSS** — UI styling and responsive design (with native Dark / Light / Auto mode)
* **JavaScript** — Client-side interactions and dynamic form handling
* **PHP** — Backend / server-side logic
* **MySQL** — Relational database

---

## Requirements

Install PHP (with MySQL PDO extension) and MySQL server locally:

* **Ubuntu / Debian / WSL:**
  ```bash
  sudo apt update
  sudo apt install -y php-cli php-mysql mysql-server
  ```
* **Fedora / RHEL:**
  ```bash
  sudo dnf install -y php-cli php-mysqlnd mysql-server
  ```

Make sure the MySQL service is running:
```bash
sudo systemctl start mysql    # Ubuntu / Debian / WSL
# or
sudo systemctl start mysqld   # Fedora / RHEL
```

---

## Installation & Setup

### 1. Clone the repository

```bash
git clone https://github.com/blezecon/Student-Feedback-sys.git
cd Student-Feedback-sys
```

### 2. Configure Database Credentials (Optional)

If your local MySQL uses a password, open `config/db_connect.php` and set it:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'student_feedback');
define('DB_USER', 'root');
define('DB_PASS', ''); // Set your MySQL password here if not blank
```

### 3. Import Database Schema

Import the schema to create the database and required tables:

```bash
mysql -u root -p < database/schema.sql
# Or if root has no password / using sudo:
sudo mysql < database/schema.sql
```

> **WSL / Ubuntu Troubleshooting:** If you get `Access denied for user 'root'@'localhost'`, run this once in terminal:
> ```bash
> sudo mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED BY ''; FLUSH PRIVILEGES;"
> ```

---

## Running the Application

Open a terminal in the project's root directory:

```bash
php -S localhost:8000
```

Open your browser and visit:

**http://localhost:8000**

*(Press `Ctrl + C` in the terminal to stop the server).*

---

## Creating an Admin Account

Public registration is only available for **Students** and **Teachers**. Newly registered accounts require admin approval before they can log in.

To set up your initial Administrator account:

1. Open **http://localhost:8000/auth/register.php** in your browser and register an account.
2. Promote your account to **Admin** by running this one-liner in your terminal:

```bash
sudo mysql student_feedback -e "UPDATE users SET role = 'admin', is_verified = 1 WHERE email = 'your_email@gmail.com';"
```

*(Or if your MySQL root uses a password: `mysql -u root -p student_feedback -e "UPDATE users SET role = 'admin', is_verified = 1 WHERE email = 'your_email@gmail.com';"`)*

3. You can now log into the **Admin Portal** at **http://localhost:8000/auth/admin_login.php**.

---

## Notes

* Bootstrap and all SVG icons are stored locally in `assets/`, so no internet connection is required to run the frontend.
* MySQL must be running while using the application.
* PHP's built-in web server is intended for local development and testing.
