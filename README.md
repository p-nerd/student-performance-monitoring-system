# Student Performance Monitoring System

Student Performance Monitoring System with raw PHP

## Description

The **Student Performance Monitoring System** is a web-based application built with raw PHP. This system helps educators and administrators monitor and track students' academic performance over time. By providing a user-friendly interface, the application facilitates the collection, analysis, and visualization of student performance data, aiding in making informed decisions to improve educational outcomes.

## Features

-   **Student Management**: Add, update, and delete student information.
-   **Performance Tracking**: Record and view students' grades, attendance, and other performance metrics.
-   **Reporting**: Generate reports on individual and group performance.
-   **Visualization**: Visualize performance data through charts and graphs.
-   **User Authentication**: Secure login for administrators, teachers, and students.
-   **Notifications**: Automated alerts for performance issues or achievements.

### Prerequisites

-   PHP 8.3.8 or higher
-   MySQL 8.3.0 or higher
-   Composer 2.7.7 or higher (for dependency management)

### Installation

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
    - Update the database configuration in `conf/db.php`.
    - Optionally, seed the database from `db/seed.sql`.

4. **Create Necessary Directories**
    ```sh
    php scripts/tmp-dir.php
    php scripts/link-images.php
    ```

<!-- 4. **Configure Environment Variables** -->
<!--    - Create a `.env` file in the root directory. -->
<!--    - Add the necessary environment variables (database credentials, etc.). -->

5. **Run Development Server**
    ```sh
    cd public && php -S localhost:9000
    ```

### Usage

1. **Login**

    - Access the application through the web browser.
    - Use the provided admin credentials to log in.

2. **Manage Students**

    - Navigate to the "Students" section to add, update, or delete student records.

3. **Track Performance**

    - Use the "Performance" section to record grades, attendance, and other metrics.

4. **Generate Reports**

    - Go to the "Reports" section to generate and view performance reports.

5. **Visualize Data**
    - Use the "Dashboard" to view charts and graphs of the collected data.

### License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

### Contact

For any questions or feedback, please contact [shihab4t@gmail.com](mailto:shihab4t@gmail.com) or visit my website to learn more about me: [developershihab.com](https://developershihab.com).
