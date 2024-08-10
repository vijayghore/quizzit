
# Quizzit

Quizzit is a quiz application built using CodeIgniter 4. The project allows students to register, log in, and participate in quizzes. The application is designed to be simple, scalable, and easy to extend with additional features.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [Project Structure](#project-structure)
- [Features](#features)
- [Contributing](#contributing)
- [License](#license)

## Requirements

- PHP 7.3 or higher
- MySQL 5.6 or higher
- Composer
- Apache/Nginx Web Server

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/vijayghore/quizzit.git
   ```

2. **Navigate to the project directory:**

   ```bash
   cd quizzit
   ```

3. **Install the dependencies:**

   ```bash
   composer install
   ```

4. **Set up your environment file:**

   Copy the `.env.example` to `.env` and modify the database settings to match your local setup.

   ```bash
   cp env.example .env
   ```

   Update the following lines in the `.env` file:

   ```bash
   database.default.hostname = localhost
   database.default.database = quizzit_db
   database.default.username = your_username
   database.default.password = your_password
   database.default.DBDriver = MySQLi
   ```

5. **Generate the application key:**

   ```bash
   php spark key:generate
   ```

## Database Setup

1. **Create the database:**

   Make sure to create a MySQL database named `quizzit_db` (or as specified in your `.env` file).

   ```sql
   CREATE DATABASE quizzit_db;
   ```

2. **Run the migrations:**

   Use CodeIgniter's migration feature to create the necessary tables.

   ```bash
   php spark migrate
   ```

## Running the Application

1. **Start the development server:**

   CodeIgniter provides a built-in development server for testing.

   ```bash
   php spark serve
   ```

   The application will be accessible at `http://localhost:8080`.

## Project Structure

- **app/Controllers**: Contains all the controllers.
- **app/Models**: Contains all the models.
- **app/Views**: Contains the view files for the user interface.
- **app/Database/Migrations**: Contains the migration files for database schema.

## Features

- **User Registration**: Students can create an account.
- **User Login**: Registered students can log in to the system.
- **Quizzes**: Participate in quizzes (to be implemented).

## Contributing

Contributions are welcome! Please follow the steps below to contribute:

1. Fork the repository.
2. Create a new branch: `git checkout -b feature-name`.
3. Make your changes and commit them: `git commit -m 'Add feature'`.
4. Push to the branch: `git push origin feature-name`.
5. Submit a pull request.

## License

This project is open-source and you can also contribute.
