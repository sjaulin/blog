# Mise en route

## Docker

1) Installer Docker
https://docs.docker.com/desktop/

2) Lancer les conteneurs
> docker docker-compose up -d

## Installer les dépendances via composer
1) Se connecter au conteneur web
> docker exec -it blog-ocr_php-apache_1  /bin/bash

2) Depuis le conteneur web, lancer les commandes :
> composer install
> composer update

## Construire la base de données
Deux choix : La structure seule ou la structure + jeu de données.
Deux fichiers SQL sont disponibles :
- structure.sql
- structure+data.sql

1) Accéder à PhpMyAdmin : http://localhost:8000/
    - Username : testuser
    - Password : testpassword

2) Aller dans l'onglet "Import"
Iporter un des deux fichiers .sql

### Accéder au blog
- L'e blog est accessible sur : http://localhost/
