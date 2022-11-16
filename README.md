Lumen Rest API Test Task
---------------------

<div><h4>PHP version: 7.4</h4></div>

<div><h4>Lumen version: 8.x</h4></div>

<p><i>Please use this password for the auto-imported users: <strong>111111</strong></i></p>

Installation & Instructions
------------------

1. composer install
2. cp .env.example .env
3. php artisan migrate:refresh --seed
4. php artisan passport:install
5. php -S localhost:8000 -t ./public

<p>Run unit test</p>

```bqsh
phpunit
```

Postman Documentation URL
------------------

https://documenter.getpostman.com/view/1089058/2s8YmLvP4u
