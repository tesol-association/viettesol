<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel 5.7

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Viettesol WepApp
 Viettesol is Conference Manager System. It's has create new conference, set up conference timeline, conference announcement and manager paper, abstract and author. It's provide many way to review abstract: open review, single blind review, double blind review. 
## Pre-require

Install XAMPP PHP 7.2
```bash
https://www.apachefriends.org/download.html
```

Install Composer
```bash
https://getcomposer.org/download/
```

## Installation

Clone Project In htdocs in XAMPP
```bash
git clone https://github.com/tesol-association/viettesol.git
```

Cd Project
```bash
cd viettelsol
```

Install php composer package
```bash
composer install
```
Copy file .env
```bash
cp .env.example .env
```
Run
```bash
php artisan key:generate
```
Import Database in database/mysql/viettesol.sql
```
Config XAMPP Virtual Host has url viettesol-dev.test or run php artisan serve
```

Open Browser type
```bash
viettesol-dev.test/login or localhost:8000/login
```
Acc: admin@gmail.com  
pass: 1234567  
use route:
```
viettesol-dev.test/admin/conference/create  or localhost:8000/admin/conference/create 
```
to create a new Conference
