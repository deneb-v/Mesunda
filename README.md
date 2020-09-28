# Mesunda

BNCC Praetorian Web Programming Training Final Project.

## Requirement
- [XAMPP](https://www.apachefriends.org/index.html)
- [Composer](https://getcomposer.org/download/)

## First time configuration
1. Open XAMPP control panel then start Apache and Mysql module.
2. Open http://localhost/phpmyadmin/ then create new database for this project.
3. Clone / download this project.
4. Open project file folder and duplicate `.env.example` file.
5. Rename the duplicated file to `.env` then open the file.
6. Look for this section
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
    ```
7. Then replace `DB_DATABASE=laravel` into `DB_DATABASE=[The Database Name That You Created]` (example: `DB_DATABASE=mesunda`).
8. Open Command Prompt at the project file directory.
9. Run this command
    ```
    composer install
    php artisan key:install
    php artisan migrate
    php artisan db:seed
    ```

## How to run this project
1. Open XAMPP control panel then start Apache and Mysql module.
2. Open Command Prompt at the project file directory.
3. Run this command
    ```
    php artisan serve
    ```
    Now you can open this project at http://127.0.0.1:8000.
