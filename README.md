Mini CRM

Feature:
- Login as Admin
- Add/Update/Delete Companies
- List all Companies (10 per page)
- List all Employess (on Company overview page)
- Add/Update/Delete Employees

Development:
- Laravel 8
- Vue 3
- Seeder for generating companies and admin user
- mysql
- Laravel Sanctum (Auth)
- db name: minicrm

Prerequisite:
- composer
- node.js
- npm

Credential:
Email: admin@admin.com
Pass: password

Setup:
- Extract file on xampp/htdocs (I'm using xampp)
- Open terminal in project directory
- Create database:
  - run "mysql -u root -p"
  - run "create database minicrm" to create database
  - exit
- Table migration:
  - run "php artisan migrate"
- Create admin credentials
  - run "php aritsan db:seed --class=UserSeeder"
- run "npm install"
- run xampp Apache and Mysql
- run "php artisan storage:link"
- run "php artisan serve"
- run "npm run dev"

To populate 1 random company data just run "php artisan db:seed class=CompanySeeder"

Local link: http://127.0.0.1:8000/

Screenshots:

![image](https://user-images.githubusercontent.com/72533239/159283282-ae6a8119-6c33-45df-a238-22e27f9e5e2f.png)

![image](https://user-images.githubusercontent.com/72533239/159283090-89444a2d-bc4f-45f0-993e-11908abdd442.png)

![image](https://user-images.githubusercontent.com/72533239/159283233-417e02a6-54cf-4b0e-8143-cfc75e3c1bf1.png)

![image](https://user-images.githubusercontent.com/72533239/159283353-3b94240a-d973-45fd-b0a6-a2a297530cae.png)

![image](https://user-images.githubusercontent.com/72533239/159283423-85695c4e-131e-4d0c-b369-83db9e700855.png)

![image](https://user-images.githubusercontent.com/72533239/159283493-5df2b601-7d2e-4379-a2a6-aadeb332a305.png)

![image](https://user-images.githubusercontent.com/72533239/159283573-40cf90c9-c624-4b48-9c87-55293fd824ac.png)
