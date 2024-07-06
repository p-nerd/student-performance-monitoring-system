# Student Performance Monitoring System

Student Performance Monitoring System with raw PHP. For details, check out the [project case study](https://developershihab.com/projects/student-performance-monitoring-system) on my website.

The **Student Performance Monitoring System** is a web-based application built with raw PHP. It helps educators track students' academic performance through data collection, analysis, and visualization. This project was undertaken as part of an internship at [Systech Digital Limited](https://systechdigital.com)

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

## Contact

For questions or feedback, contact [shihab4t@gmail.com](mailto:shihab4t@gmail.com) or visit [developershihab.com](https://developershihab.com).

