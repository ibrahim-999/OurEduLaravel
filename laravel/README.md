# User Transactions

## Task Description

We have two providers that collect data from them in json files. We need to read them then
insert them into the relation database schema and make some filter operations on them to get
the result.
You can check the json files inside jsons folder
1. users.json
2. transactions.json
   we have three status for transactions
- authorized which will have statusCode 1
- decline which will have statusCode 2
- refunded which will have statusCode 3

## Prerequisite
- PHP 8.1
- Laravel 10.10
- Mysql for database

## Installation

### Step 1.
- Begin by cloning this repository to your machine
```
git clone `repo url` 
```

- Install dependencies
```
composer install
```

- Create environmental file and variables
```
cp .env.example .env
```

- Generate app key
```
php artisan key:generate
```

### Step 2
- Next, create a new database and reference its name and username/password in the project's .env file.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 3
- To start the server, run the command below
```
php artisan serve
```

## Application Route
```
http://127.0.0.1:8000
```

## Task Expectations

Implement this APIs should contain :-
- list all users which combine transactions from all the available provider and database
- should be able to filter the result three statusCode (authorized, decline, refunded)
- should be able to filter the result three Currency
- it should be able to filter by amount range
- it should be able to filter by date range

## Author
- ibrahim khalaf
