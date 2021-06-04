# Symfony Project with Domain Driven Design (DDD)

## Description

This project is sample stack with Symfony 5 into Docker containers using Docker-compose,
using MySQL 8 as a database.

## Installation

1. Run `docker-compose up -d`

```
Creating symfony-ddd_db_1    ... done
Creating symfony-ddd_php_1   ... done
Creating symfony-ddd_nginx_1 ... done
```

2. Use this value for the DATABASE_URL environment variable of Symfony:

```
DATABASE_URL=mysql://user:sample@db:3306/app_db?serverVersion=5.7
```

User and password of the database is the `env` file at the root of the project.

3. In your dev environment add this line in your hosts file:
```
127.0.0.1 dev.app.com
```

4.- Tools for testing, fixed and evalute code.

For execute PHPUnit, PHPStan, Psalm and PHP-cs-fixer in development time

- for execute PHPUnit
```
docker exec -ti symfony-ddd_php_1 php vendor/bin/phpunit
```
- execute PHPStan
```
docker exec -ti symfony-ddd_php_1 php vendor/bin/phpstan
```
- execute Psalm
```
docker exec -ti symfony-ddd_php_1 php vendor/bin/psalm --show-info=true
```
- execute PHP-cs-fixer
```
docker exec -ti symfony-ddd_php_1 php vendor/bin/php-cs-fixer fix src
```

## References
https://www.fabian-keller.de/blog/domain-driven-design-with-symfony-a-folder-structure/
