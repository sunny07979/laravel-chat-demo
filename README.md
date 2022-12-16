## Laravel messaging system

## Requirement

This repository comes with messaging system using Laravel 9. The system should be able to view, send, receive, and delete messages between various users.

## Installation Instructions

Run following commands in terminal:
1. Clone this repo
   ```sh
   git clone https://github.com/sunny07979/laravel-chat-demo.git
   ```
   ```
   cd laravel-chat-demo
   ```
   ```
   cp .env.example .env
   ```
2. Create a MySQL database for the project and update database credentials of env variables `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` into .env file

3. Install Composer packages
   ```sh
   composer install
   ```
4. Install NPM packages
   ```sh
   npm install
   ```
5. Generate new APP_KEY
   ```php
   php artisan key:generate
   ```
5. Initilise the database
   ```php
   php artisan migrate
   ```
   This will generate tables in database and some random users records.

6. Compile the webpages and run it
   ```sh
   npm run dev
   ```
   ```php
   php artisan serve
   ```

   - Access the application. Example: `http://127.0.0.1:8000`
   - For login, You can use any email from the users table.
   - All user's password is "password"
