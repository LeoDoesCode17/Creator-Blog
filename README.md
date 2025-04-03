## About Creator Blog

Creator Blog is a project-based learning initiative that I built during my 6th semester in college. The goal of this project is to deepen my knowledge of Laravel development. For the UI, I'm using Alpine.js and components from Tailwind UI.

## How You Use This In Your Local Machine

### 1. Clone this project 
Using SSH   : `git clone git@github.com:LeoDoesCode17/Creator-Blog.git` <br>
Using HTTPS : `git clone https://github.com/LeoDoesCode17/Creator-Blog.git`

### 2. Install all dependencies (PHP and JS)
For PHP dependencies : `composer install` <br>
For JS dependencies  : `npm install`

### 3. Setup your .env
Copy .env.example to generate your .env : `cp .env.example .env`

### 4. Configure your database in .env
Set your database name (must be created beforehand) <br>
Provide your DBMS (MySQL, PostgreSQL, etc), username, and password

### 5. Run all migration and seed(initialize data) in your database
Command : `php artisan migrate:fresh --seed`

### 6. Run the project (Run these two command)
Commands : `php artisan serve` and `npm run dev`

