     URL-shortener app

The entry point for the application is "/" where the user can enter the original long url in the first input "Please enter the URL". Buy submitting the "Generate short id" button the hash for this url will be generated and saved to the DB along with the original url.
This hash consists of 4 characters and is unique. 
In order to be redirected to the original url the user should enter the hash to the "Enter hash for redirect to the url" field and submit the redirect button.
There is also the counter, which calculates the number of redirections to each url. It is saved in the DB as the "times" field.
When entering the invalid or empty url or hash the appropriate responses with HTTP statuses are returned.
There is also a list of all urls saved presented in the api by "/api/all" endpoint.

Run the project:
- Clone the repository 
- Set your DB config in the .env file
- Install the dependecies with composer install
- Run the migrations to DB with php artisan migrate
- Run the application with php artisan serve
