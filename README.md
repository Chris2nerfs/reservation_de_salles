# Environnement LAMP basé sur Docker Compose

## Usage

Pour démarrer l’environnement, exécutez simplement:

```
$ docker-compose up -d
```

Le serveur apache est alors disponible sur le port `80` et sert le dossier  `www`.

phpMyAdmin est disponible sur le port `9000`.

MariaDB est disponible sur le port `3306`. L’utilisateur `root` a le mot de passe `Chris709` par défaut.

Mailhog est accessible sur le port `8025`.

## Services

* PHP 7.2
* Apache 2.4
* MariaDB 10.4
* phpMyAdmin 4.9
* Mailhog

### Modules PHP installés

* curl
* gd
* intl
* json
* mbstring
* mcrypt
* mysqli
* pdo
* pdo-mysql
* pdo-sqlite
* tokernizer
* xdebug
* zip
