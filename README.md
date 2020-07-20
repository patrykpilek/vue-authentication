# Vue Authentication

This contains the application code for the Vue Authentication. The app is build on top of [Laravel framework](http://laravel.com/docs) which runs on the LEMP stack (NGINX, MySQL, and PHP-FPM).

## Setting up

Follow these steps to set up the project.

```
git clone <project.url> <project>
cd <project>
composer install
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 777 bootstrap/cache
chmod -R 777 storage
cp .env.example .env
```
Change the values of the `.env` file as necessary.
```
php artisan key:generate
php artisan migrate:install
php artisan migrate
php artisan passport:install
```
Copy value from personal access client to `.env`
```
example:
...
Clien ID:1
Client secret:epUa4601VNmqu3JEsbeFpbOIZVL79faEylKxdUjB

PASSPORT_PERSONAL_ACCESS_CLIENT_ID=1
PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=epUa4601VNmqu3JEsbeFpbOIZVL79faEylKxdUjB
```
Copy private and public key to `.env`
```
example:
...
PASSPORT_PRIVATE_KEY="-----BEGIN RSA PRIVATE KEY-----
<private key here in storage folder>
-----END RSA PRIVATE KEY-----"

PASSPORT_PUBLIC_KEY="-----BEGIN PUBLIC KEY-----
<public key here in storage folder>
-----END PUBLIC KEY-----"
```
After that you can remove private and public files from storage folder.


## Deploying app to production

Follow the instructions mentioned here.
