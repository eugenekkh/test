Installation
------------
Clone repository
```shell
git clone https://github.com/eugenekkh/test.git test
```

Go to the project directory and execute composer install
```shell
composer install
```

Create database and execute migrations
```shell
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

Execution
---------
Go to the public directory and run integrated php web server
```shell
cd ./public
php -S 0.0.0.0:8080
```

Open the project in your browser http://127.0.0.1:8080

Console commands
----------------
```shell
# To add an ip address for check
php bin/console app:ipcheck:add <ip address>
```

```shell
# Check all ip addresses
php bin/console app:ipcheck:perform
```

Cron
----
Copy cron file from the project root to /etc/cron.d and replace path to bin/console
```shell
cd /path/to/project
PROJECT_ROOT=`pwd`
sed "s:</path/to>:${PROJECT_ROOT}:g" cron > /etc/cron.d/symfony
```

Testing
-------
Initialize testing environment
```shell
php bin/console cache:clear -e test
php bin/console doctrine:database:create -e test
php bin/console doctrine:migrations:migrate -e test
```

Run tests
```shell
php bin/phpunit
```
