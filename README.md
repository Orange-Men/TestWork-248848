## Tasks
1. The project contains a database of two tables with a many-to-many relationship;
2. The database has to be managed through a repository pattern;
3. Simple key authentication must be implemented (without using passport, jwt etc. packages);
4. API must allow access to data with sorting and multi-field search capability;
5. The pivot attribute for models should be used in data manipulation and included in search queries;
## Setup guide
1. ~~Create .env file~~ Done
2. `composer install`
3. `./vendor/bin/sail up -d`
4. `./vendor/bin/sail php artisan migrate --seed`

> Postman collection: `./test-work.postman_collection.json`

> Run tests: `./vendor/bin/sail php artisan test`
