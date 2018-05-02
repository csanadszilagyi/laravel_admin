# laravel_admin
Simple admin dashboard built with Laravel 5.6.

Features:
- login and register funcionality (register temporarily removed)
- user roles and permissions
  - as an admin, you can see all the pages
  - with other roles, pages are shown according to role permissions
- captcha shows up after 3 failed login atempts
- sessions, users stored in database

Installing steps:
  - clone this repo
  - rename .env.example file to .env
  - set your database info and app name here
  - composer install
  - php artisan key:generate
  - composer dump-autoload
  - php artisan migrate:refresh --seed 
    - it makes the migrations and adds users with roles: Admin, User 1, User 2, User 3
    - password for all users is: test77
  - to change frontend things, additionally you can run: npm install, npm run dev
