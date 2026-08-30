# Shipping Admin Panel

A small Laravel + Filament admin system for managing e-commerce orders and their
shipping methods.

## Stack

- **Laravel** 12
- **Filament** v4
- **PHP** 8.2+ required
- **PHPUnit** 11

## Requirements

- Composer
- A MySQL (or compatible) database

## Setup

1. Clone the repository:

       git clone <repo-url>
       cd laravel-filament-solid-task

2. Install PHP dependencies:

       composer install

3. Copy the environment file and generate an app key:

       cp .env.example .env
       php artisan key:generate

4. Configure your database connection in `.env`:

       DB_CONNECTION=mysql
       DB_HOST=127.0.0.1
       DB_PORT=3306
       DB_DATABASE=your_database_name
       DB_USERNAME=your_username
       DB_PASSWORD=your_password

5. Run migrations and seed the database (creates 30 sample orders):

       php artisan migrate --seed

6. Create a Filament admin user to log in with:

       php artisan make:filament-user

## Running the project

Start the local development server:

    php artisan serve

Visit the admin panel at:

    http://127.0.0.1:8000/shipping-admin

Log in with the credentials you created in step 6 above.

## Running the tests

### One-time test environment setup

The feature test (`MarkAsShippedActionTest`) boots the full application and uses
`RefreshDatabase`, so it needs its own database — separate from your development
database, so it never wipes your seeded orders. Create a `.env.testing` file in the
project root (if it's not there):

    APP_ENV=testing
    APP_KEY=
    DB_CONNECTION=sqlite
    DB_DATABASE=:memory:

Then generate an app key for it:

    php artisan key:generate --env=testing

This requires the `pdo_sqlite` PHP extension to be enabled. Check with:

    php -m | Select-String sqlite

If it's not listed, uncomment `extension=pdo_sqlite` in your `php.ini` (find its path
with `php --ini`) and restart any running PHP process.

### Running the suite

Run the full test suite:

    php artisan test

Run only the shipping calculator / registry unit tests (no database, no
Filament — these extend PHPUnit's own `TestCase` directly):

    php artisan test --filter=Shipping

Run only the Filament/Livewire feature test:

    php artisan test --filter=MarkAsShippedActionTest

## Notes

- The Filament panel ID/path is `shipping-admin` (not the default `admin`).
