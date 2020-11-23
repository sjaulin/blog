# Install project

## LAMP environment

### On Docker
1) Install Docker
https://docs.docker.com/desktop/

2) Start containers
```
$ docker docker-compose up -d
```

3) To run a command in php/apache container
```
docker exec -it blog-ocr_php-apache_1  /bin/bash
```

### On XAMPP
1) Install XAMPP
https://www.apachefriends.org/

## Sources
Clone git project and put all files in DocumentRoot folder on your documentRoot 

## Environment config

### Dependencies & autoload
```
composer dumpautoload
composer install
```

### Database
Init database with database.sql

If you use Docker : http://localhost:8000/
    - Username : testuser
    - Password : testpassword
