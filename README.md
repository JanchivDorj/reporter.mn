## Install reportermn

**env**
```
DB_DATABASE=reportermn
DB_USERNAME=homestead
DB_PASSWORD=secret
```

## Composer

sudo composer install

## config .env file
```
cp .env.example .env
php artisan key:generate
```
## file permission

sudo chmod -R 777 /public

**Migrate to MySQL**

$ php artisan migrate --seed --force

## Login Super Account
```
username => admin
password => abc123
```