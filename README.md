﻿# backend-test

1. Composer 
    ```
    composer update
    composer install
    ```
2. Command line & Setting your database 
    ```
    cp .env.example .env
    ```
3. Create Database 
    ```
    php artisan migrate
    ```
4. After that
    ```
    php artisan db:seed --class=JobsSeeder
    php artisan db:seed --class=SkillsSeeder
    ```
5. and Finally
    ```
    php artisan serve
    ```
6. Enjoy the program with Postman
