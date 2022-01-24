## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Prerequisites](#prerequisites)
* [Setup](#setup)

## General info
This project migrates the business data provided in CSV to the database tables and presents it to the users with an interactive UI. Users can also apply multiple filters on to the table and get an interesting and valuable data. 
	
## Technologies
Project is created with:
* Vue js: 3.1.5
* tailwind CSS: 2.2.7
* Vite: 2.4.4
* laravel: 8.75
* php: 8.1.1
* MariaDB: 10.4.22

## Prerequisites
* node js
* Laravel : 8X
* php: 8.1
* Composer
* MySQL or MariaDB
* Apache Http server. 
I have used XAAMP to get apache server, MariaDB database, PHP 8.1.1  

## Setup
To run this project:

* Pull this git project from master branch, or if you already have this project the use it (if using xammp then pull the project in htdocs folder)
* create a database name in MySQL or MariaDB or any SQL server.
* In the root folder of the project, create the .env file or edit if exists. Provide database name, user name, and password of the database in the .env file.
* Get the backend dependencies by the following command 
```
composer install
```
* Run the below command to migrate the tables in to the database
```
php artisan migrate
```
*  Now migrate the CSV file to database by the below command 
```
php artisan db:seed
```
* try this for seeding if the above command could not run
```
php artisan migrate:fresh --seed
```
* Get the frontend dependencies by the following command
```
npm install
```
* Run the backend server 
```
php atrisan serve
```
* Run the frontend vite server
```
npm run dev
``` 
Your aplication is ready to use!


