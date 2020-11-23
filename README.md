# Install project

## 1. LAMP environment

### 1.1 On Docker
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

### 1.2 On XAMPP
1) Install XAMPP
https://www.apachefriends.org/

## 2. Sources
Clone git project and put all files from DocumentRoot folder to your web server documentRoot 

## 3. Configure your environment
- Modify config/environment.example.php with your config 
- Rename file to config/environment.php

## 4. Dependencies & autoload
```
composer dumpautoload
composer install
```

## 5. Init Database
- Import database.sql in your database

If you use Docker you can use phpMyAdmin : http://localhost:8000/
    - Username : testuser
    - Password : testpassword
