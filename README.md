# Installation

Lien de l'image : https://hub.docker.com/r/mattrayner/lamp

## Lancement / première installation
```
docker run -p "80:80" -v ${PWD}/app:/app mattrayner/lamp:latest-1804
```

### Dossier de l'application 
Une fois le conteneur lancé, un doccier app est créé. C'est dans ce dossier qu'il faut déposer les sources du projet

### Adresse
L'application est accessible sur http://localhost
