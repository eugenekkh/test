Task
----
1. Создать проект на актуальной версии фреймворка Symfony.
2. Создать форму проверки ip-адреса. Для проверки использовать API https://2ip.ua/ru/api/our-api
3. Сохранять результаты проверки в базу (Лучше использовать SQLite)
4. Написать команду, которая выполняет проверку.
5. Команда должна выполняться раз в сутки. В каталоге с проектом сохранить файл с командой для cron. Результаты также сохраняем.
6. Результаты последних 10 запросов выводить на той же странице, под формой.

Проверка должна выполняться сразу после отправки данных с формы. Записывать исходные данные, чтобы в дальнейшем командой можно было "освежить" результат выполняя ежедневную команду, например через крон

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
