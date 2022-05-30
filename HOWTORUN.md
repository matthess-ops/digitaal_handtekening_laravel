- use .env.example as env
- composer install
- npm install
- create all the dbs
- add some documents to to storage/public/documents and storage/public/signatureDocuments
- if you want to use the test documents uncomment DocumentSeeder and SignatureSeeder in DatabaseSeeder.php
- php artisan migrate:refresh --seed
- php artisan serve --host=localhost --port=8000 must be host localhost and port 8000 because spa front end (axios.defaults.baseURL in main.js) uses this as default path for laravel sanctum. Can be changed but the axios.defaults.baseURL has to be changed in main.js
- see userseeder for two test accounts, first one is an admin other is just a user

