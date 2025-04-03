## About Creator Blog

Creator Blog is a project-based learning that i build during my 6th semester in my college. This project purpose is to deeper my knowledge about Laravel Development. For the UIs, i'm using Alpine.JS and components from Tailwind UI.

## How You Use This In Your Local Machine

### 1. Clone this project 
Using SSH   : `git clone git@github.com:LeoDoesCode17/Creator-Blog.git`
Using HTTPS : `git clone https://github.com/LeoDoesCode17/Creator-Blog.git`

### 2. Install all dependencies (PHP and JS)
For PHP dependencies : `composer install`
For JS dependencies  : `npm install`

### 3. Setup your .env
Copy .env.example to generate your .env : `cp .env.example .env`

### 4. Configure your database in .env
Set your database name (must be created beforehand)
Provide your DBMS (MySQL, PostgreSQL, etc), username, and password

### 5. Run all migration and seed(initialize data) in your database
Command : `php artisan migrate:fresh --seed`

### 6. Run the project (Run these two command)
Commands : `php artisan serve` and `npm run dev`

