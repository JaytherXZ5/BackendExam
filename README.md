1. Open your command terminal and clone repository:

     C:\Users\User>Desktop> git clone https://github.com/JaytherXZ5/BackendExam.git
     >cd Project

2. Open the project in your IDE, ex: VS CODE

3. Install Node.js if you haven't already:  
   Download and install from -> https://nodejs.org/

4. Open project terminal and run: 
    > npm install
    
5. I used XAMPP-MYSQL. 
    Download and Install -> https://www.apachefriends.org/

6. Add path C:\xampp\php in your System Environment Variables.

7. If you don't have composer yet, 
    Download and install Composer-Setup.exe -> https://getcomposer.org/download/

8. Back in your project terminal run: 
    > composer install
    
9. Copy and paste the .env.example file and rename it to .env

10. Open XAMPP and start Apache and MySQL. Open Mysql admin and create a new empty database.

11. Inside the .env file modify and connect your database ex:

    DB_CONNECTION=mysql

    DB_HOST=127.0.0.1

    DB_PORT=3306

    DB_DATABASE= db_name

    DB_USERNAME=root

    DB_PASSWORD=


12. Generate Laravel application key APP_KEY=. run in terminal:
    > php artisan key:generate
    
13. Run database migration in terminal:
    > php artisan migrate

14 Navigate to database/seeders/UserFactory.php. 
    Create account credentials and run command:
    
    > php artisan db:seed --class=UserSeeder

    and if you want to seed products run:
    
    > php artisan db:seed --class=ProductSeeder

15. Run the Project by running the command in the terminal:
    >npm run dev
16. Open another terminal and run:
    >php artisan serve

17. Open the project link at your localhost server http://127.0.0.1:8000
