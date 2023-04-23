
# SMSFactor - Technical test

## Context
You’re working on an online shopping platform. The sales team wants to know which items were added to a basket, but removed before checkout. We will use this data later for targeted discounts.
Build a shopping basket that helps you get this data. You are free to use the languages, frameworks and tools you prefer.



## Tech Stack

**Client:** VueJs

**Server:** Laravel

**Database:** SQLite


## Installation

After cloning the project, run the command : 

```bash
  #For VueJs
  npm install 

  #For Laravel
  composer install
```
Create a ".env" file at the root of the project and paste the contents of the "example.env" file into it.

Then, run :

```bash
  php artisan key:generate
```

and :

```bash
  php artisan config:clear
```

Now you need to create a file "database.sqlite" in the root of the "database" folder.


Run :

```bash
  php artisan migrate
```
to create the database tables. And :

```bash
  php artisan db:seed --class=ProductSeeder
```

Finaly, run :

```bash
  php artisan serve
```

to start the application.