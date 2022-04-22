## Setup guide
1. ~~Create .env file~~ Done
2. `composer install`
3. `./vendor/bin/sail up -d`
4. `./vendor/bin/sail php artisan migrate --seed`

> Postman collection: `./test-work.postman_collection.json`

> Run tests: `./vendor/bin/sail php artisan test`
