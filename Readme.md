# Symfony Project with Domain Driven Design (DDD)

## Description

This project is sample stack with Symfony 5 into Docker containers using Docker-compose,
using MySQL 8 as a database.

## Installation

1. Run `docker-compose up -d`

```
Creating symfony-docker_db_1    ... done
Creating symfony-docker_php_1   ... done
Creating symfony-docker_nginx_1 ... done
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

