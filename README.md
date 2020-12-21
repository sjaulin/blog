# Blog

Code Climate :
[![Maintainability](https://api.codeclimate.com/v1/badges/ce6c2859b6545a32c2a4/maintainability)](https://codeclimate.com/github/sjaulin/blog-ocr/maintainability)

Codacy :
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/14dfa3e49d344aa9a7e6e2544b061bf3)](https://www.codacy.com/gh/sjaulin/blog-ocr/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=sjaulin/blog-ocr&amp;utm_campaign=Badge_Grade)

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
Clone git project and put all files from web folder to your web server documentRoot 

## 3. Configure your environment
- Modify environment.example.php with your config 
- Rename file to environment.php

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
