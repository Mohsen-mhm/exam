<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About project

Exam site using Laravel and Tailwind.CSS

- **Laravel**
- **PHP**
- **Tailwind**
- **Flowbite**
- **Js**

## Getting Started

Clone the project repository by running the command below if you use SSH

```bash
git clone git@github.com:Mohsen-mhm/exam.git
```

If you use https, use this instead

```bash
git clone https://github.com/Mohsen-mhm/exam.git
```

After cloning, run:

```bash
composer install
```

and:

```bash
npm install
```

Duplicate `.env.example` and rename it `.env`

Then run:

```bash
php artisan key:generate
```

-------------------------

### !! important !!

set your **name**, **email** and **password** in `config/app.php` to insert first user as admin in database

-------------------------

#### Database Migrations

Be sure to fill in your database details in your `.env` file before running the migrations:

```bash
php artisan migrate
```

And finally, start the application:

```bash
php artisan serve
```

visit [http://localhost:8000](http://localhost:8000) to see the application in action.
