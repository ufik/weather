weather_app
===========

A Symfony project created on December 10, 2015, 8:33 pm.

Install
=======

```
composer install

php app/console doctrine:database:create
php app/console doctrine:schema:create
php app/console doctrine:fixtures:load -n
```

Download initial data
```
php app/console weather:download-data

```

Run symfony web server
```
php app/console server:run
```

Then you can run service in your browser

http://127.0.0.1:8000/index.json?lat=50.154897&long=14.697661&datetime=1449779060

Insert into crontab for hourly updates

* */1 * * * php /path/to/application/app/console weather:download-data
