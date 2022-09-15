# Trt Consulting - ECF Backend

Une agence de recrutement spécialisée dans l’hôtellerie et la restauration désire avoir un produit minimum viable afin
de tester si la demande est réellement présente.

L’agence souhaite proposer pour l’instant une simple interface avec une authentification.

4 types d’utilisateur devront pouvoir se connecter :

- Les recruteurs : Une entreprise qui recherche un employé.
- Les candidats : Un serveur, responsable de la restauration, chef cuisinier etc.
- Les consultants : Missionnés par TRT Conseil pour gérer les liaisons sur le back-office entre
  recruteurs et candidats.
- L’administrateur : La personne en charge de la maintenance de l’application.

## Demo

Une démonstration du projet est disponible - [Trt Consulting](https://trt-consulting.herokuapp.com/)

Pour tester l'application en Administrateur :

````
id : admin@trt-consulting.com
mdp: password
````

Pour tester l'application en Consultant :

````
id : consultant@trt-consulting.com
mdp: password
````

Pour tester l'application en candidat :

````
id : candidate@trt-consulting.com
mdp: password
````

Pour tester l'application en recruteur :

````
id : recruiter@trt-consulting.com
mdp: password
````

## Documentation

- [Diagramme de classe](documentation/TRT-Consulting-Diagramme-de-classe(notation%20UML).pdf))
- [Manuel d'utilisation](./documentation/Trt-Consulting-Manuel-d-utilisation-09-2022.pdf)

## Installation en local

Pour installer le projet en local, rendez-vous dans votre dossier d'installation

```bash
 git clone <link to repository>
```

Une fois cloner, ouvrez votre IDE

```bash
composer install
npm install
npm run build
```

Creer la BDD dans votre .env

```bash
 DATABASE_URL="mysql://<ID de bdd>:<Mdp de Bdd>@127.0.0.1:3306/<Nom de votre BDD>?serverVersion=<Version de votre BDD> &charset=utf8mb4"

```

Dans le terminal

```bash
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migration:migrate
```

Lancez le serveur Symfony

```bash
symfony serve -d
```

Vous pouvez installer des données de test
Lancez le serveur Symfony

```bash
php bin/console doctrine:fixture:load
```

## Deployer le site en production

1. Creation du dossier projet sur heroku  
   ``
   heroku create <nom du projet>
   ``

2. Création d'un fichier Procfile à la racine du projet

````
## Insérer le code ci dessous ##
release: php bin/console doctrine:migrations:migrate
web: heroku-php-apache2 public/
````

3. Configurer la variable d'environnement en mode production avec la commande  
   ``
   heroku config:set APP_ENV=prod
   ``
4. Ajout de Apache  
   ``
   web: heroku-php-apache2 public/
   ``
5. Dans Heroku, ajouter le addons pour la BDD. J'ai choisi ClearDB Mysql pour son plan gratuit

- Dans le client Heroku, dans l'onglet "Settings/Config Vars", on ajoute une nouvelle Variable pour la BDD  
  ``
  DATABASE_URL="<Renseigner le lien de "CLEARDB_DATABASE_URL">"
  ``
- Dans le fichier .env à la racine du projet on modifie la DATABASE_URL avec le lien vers la BDD créee dans heroku

6. Ajout du buildpacks pour Nodejs  
   ``
   heroku buildpacks:add heroku/nodejs
   ``

- Dans le fichier package.json on ajoute en dessous de "scripts"

````
 "engines": {
        "node": "<numéro de version de node installer sur la machine>",
        "npm": "<numéro de npm installer sur la machine>"
    },
````

7. Deployement du projet sur le depot Heroku  
   ``
   git push heroku main
   ``

## Lancement des tests

```bash
  php bin/phpunit 
```

.Création de la base de donnée de test

```bash
  php bin/console doctrine:database:create --env=test
  php bin/console doctrine:schema:update --force --env=test -n
  php bin/console doctrine:fixture:load --env=test

```

Pour visualiser le Code Coverage :

```bash
php bin/phpunit --coverage-html var/log/test/test-coverage
```

la commande créee le dossier dans var/log/test


