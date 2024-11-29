# Laravel Project with Sail

This document provides a simple guide for setting up and running a Laravel project using Sail, Laravel's built-in Docker environment.

## Requirements
- Docker and Docker Compose installed on your system.
- PHP and Composer installed for initial setup (optional, if using the `./vendor/bin/sail` script).

## Getting Started

### 1. Clone the Repository
Clone the Laravel project repository:
```bash
git clone <repository_url>
cd <project_directory>
```

### 2. Install Dependencies
Install the project dependencies using Composer:
```bash
composer install
```

### 3. Configure Environment
Copy the `.env.example` file to create your `.env` file:
```bash
cp .env.example .env
```

Generate the application key:
```bash
php artisan key:generate
```

### 4. Start Laravel Sail
If Sail is not installed, you can enable it by running:
```bash
composer require laravel/sail --dev
```

Boot up the development environment:
```bash
./vendor/bin/sail up
```
This will start the Docker containers for your application.

### 5. Run Migrations
Run database migrations to set up your database schema:
```bash
./vendor/bin/sail artisan migrate
```

### 6. Access the Application
Once Sail is running, you can access the application in your browser at:
```
http://localhost
```

## Common Commands
Here are some commonly used Sail commands:

### Bring up or down the environment:
```bash
./vendor/bin/sail up    # Start the containers
./vendor/bin/sail down  # Stop the containers
```

### Running Artisan Commands:
```bash
./vendor/bin/sail artisan <command>
```

### Running Composer:
```bash
./vendor/bin/sail composer <command>
```

### Running NPM:
```bash
./vendor/bin/sail npm <command>
```

### Checking Logs:
```bash
./vendor/bin/sail logs
```

## Notes
- If you want to use Sail commands without typing `./vendor/bin/sail`, you can create an alias:
  ```bash
  alias sail="./vendor/bin/sail"
  ```
  Add this line to your `~/.bashrc` or `~/.zshrc` file for persistence.

- Ensure your `.env` file is correctly configured for database connections and other environment settings. By default, Sail uses MySQL with the following credentials:
  ```env
  DB_CONNECTION=mysql
  DB_HOST=mysql
  DB_PORT=3306
  DB_DATABASE=laravel
  DB_USERNAME=sail
  DB_PASSWORD=password
  ```

## Stopping Containers
To stop the Docker containers, run:
```bash
./vendor/bin/sail down
```

## Troubleshooting
- If you encounter permission issues, try running commands with `sudo`.
- Check your Docker installation if containers fail to start.

---

You're now ready to work on your Laravel project using Sail! For more information, consult the [Laravel Sail documentation](https://laravel.com/docs/sail).

