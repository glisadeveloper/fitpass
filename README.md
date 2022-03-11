# FitPass RestFul Api - example by Gligorije
	* Laravel ( Lumen ) API example
	* This example shows how one should restful service work
	* Through the developing process, I use Postman for testing endpoints 
	* RestFul Api support method: GET (data display), POST (data entry), PUT (updating data), DELETE (deleting data)

### Following are the Models

    * Member
    * Gym 
    * Log

### Usage

* Clone the project via git clone or download the zip file.

### .env

* Create a database and connect your database in .env file.

### Composer Install

cd into the project directory via terminal and run the following command to install composer packages.
* composer install

### Run Migration

* then run the following command to create migrations in the databbase.
php artisan migrate

### Database Seeding

* Run the following command to seed the database with dummy members contents.
php artisan db:seed --class=MemberSeeder

* Finally run the last commands to seed the database with dummy gyms content
php artisan db:seed --class=GymSeeder

### Run project via composer

php -S localhost:8000 -t public

### API EndPoints
Please use Postman collection https://www.getpostman.com/collections/2988072cc864f6e7a8d2 to test below endpoints ( also replace localhost with your domain or ip address ): 

    * Get all Members {GET} 
    	- http://localhost:8000/api/members
    * Get Member by Card ID and Object {GET}
    	- http://localhost:8000/api/reception/{card_id}/{object_name}
    * Get Member Logs by Card ID {GET}
    	- http://localhost:8000/api/reception/logs/{card_id}
    * Add Member {POST}
    	- http://localhost:8000/api/reception
    * Edit Member {PUT}
    	- http://localhost:8000/api/reception/{id}
    * Delete Meber {DELETE}
      	- http://localhost:8000/api/reception/{id}

### Other information
	* This is a simple example of creating Api from scratch using Lumen framework
	* Api contains data processing for gym members where it follows the logic that it is possible to log in to the system only once a day
