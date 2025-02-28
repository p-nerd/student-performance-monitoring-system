<p align="center">
  <img src="./public/logo.svg" alt="Student Performance Monitoring System" width="200" height="200" />
</p>

<h1 align="center">Student Performance Monitoring System</h1>

A web-based Student Performance Monitoring System developed with raw PHP,
designed to streamline academic performance tracking in educational institutions.  
The system features a Laravel-like architecture and utilizes [PDO](https://www.php.net/manual/en/book.pdo.php)
for secure database operations with [MySQL](https://www.mysql.com),
along with modern styling through [TailwindCSS](https://tailwindcss.com).

The application offers functionality including student profile management,
performance tracking with visual analytics, automated reporting systems,
and role-based access control for different stakeholders.  
Built during an internship at [Systech Digital Limited](https://www.systechdigital.com),
it demonstrates practical implementation of complex database relationships
and secure user authentication.

Key technical highlights include the use of [Composer](https://getcomposer.org)
for dependency management, integration of [spatie/browsershot](https://github.com/spatie/browsershot)
for PDF generation, and a carefully structured codebase that prioritizes maintainability and scalability.  
The system provides educators with tools for monitoring student progress,
generating insightful reports, and making data-driven decisions to improve educational outcomes.

The project showcases the ability to build applications using raw PHP
while maintaining clean code architecture and implementing modern development practices.

## Features

- **Student Management**: Add, update, and delete student information.
- **Performance Tracking**: Record and view grades, attendance, and other metrics.
- **Reporting**: Generate individual and group performance reports.
- **Visualization**: Visualize data through charts and graphs.
- **User Authentication**: Secure login for administrators, teachers, and students.
- **Notifications**: Automated alerts for performance issues.

## Prerequisites

- PHP 8.3.8 or higher
- MySQL 8.3.0 or higher
- Composer 2.7.7 or higher (for dependency management)

## Installation

1. **Clone the Repository**

    ```sh
    git clone https://github.com/p-nerd/systech-student-performance-monitoring-system.git
    cd systech-student-performance-monitoring-system
    ```

2. **Install Dependencies**

    ```sh
    composer install
    ```

3. **Configure Database**

    - Create a MySQL database.
    - Import the database schema from `db/schema.sql`.
    - Update database configuration in `conf/db.php`.
    - Optionally, seed the database from `db/seed.sql`.

4. **Create Necessary Directories**

    ```sh
    php scripts/tmp-dir.php
    php scripts/link-images.php
    ```

5. **Run Development Server**

    ```sh
    cd public && php -S localhost:9000
    ```

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## 👤 Author

**Shihab Mahamud**

- Email: shihab4t@gmail.com
- Website: [https://developershihab.com](https://developershihab.com)
- GitHub: [@p-nerd](https://github.com/p-nerd)
