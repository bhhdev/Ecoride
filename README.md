# EcoRide — Plateforme Symfony 7 (Docker)

Ce projet est une application Symfony 7 conteneurisée avec Docker, utilisant MariaDB et une architecture adaptée aux environnements **DEV** et **PROD**.  
Le code est versionné sur GitHub et les images Docker sont publiées via **GitHub Container Registry (GHCR)**.

---

## 🚀 Fonctionnalités principales
- Backend Symfony 7.3# EcoRide — Plateforme Symfony 7 (Docker)

Ce projet est une application Symfony 7 conteneurisée avec Docker, utilisant MariaDB et une architecture adaptée aux environnements **DEV** et **PROD**.  
Le code est versionné sur GitHub et les images Docker sont publiées via **GitHub Container Registry (GHCR)**.

---

## 🚀 Fonctionnalités principales

- Application Symfony 7.3
- Architecture MVC avec séparation frontend / backend
- Backend partiellement implémenté :
  - Entities Doctrine
  - Repositories
  - Authentification (inscription / connexion fonctionnelles)
- Recherche de covoiturages via **requête asynchrone réelle (AJAX → Symfony → BDD)**
- Données de test générées avec **Fixtures + FakerPHP**
- Base de données MariaDB 10.6
- Conteneurisation complète via Docker & Docker Compose
- Environnements DEV et PROD séparés
- Administration SQL via Adminer
- Déploiement automatisé via GHCR

---

## 🖥️ Environnement de développement

### 🔧 Prérequis

- Windows + WSL2 **OU** Linux Ubuntu 24.04 LTS  
- Docker Desktop  
- VS Code  
- Symfony CLI  
- Composer  
- Git  

---

## 📦 Lancement de l'environnement de développement


docker compose -f compose.dev.yaml up --build

Application :
👉 http://localhost:8080

Adminer :
👉 http://localhost:8899
🗄️ Configuration base de données DEV
Paramètre	Valeur
Host	database
Port	3306
User	bhhdev
Pass	bhhdev
DB	ecoride


⚙️ Commandes Symfony dans Docker

Toutes les commandes Symfony doivent être exécutées dans le conteneur app :

docker compose -f compose.dev.yaml exec app php bin/console ...



🔄 Gestion de la base de données
Créer la base

docker compose -f compose.dev.yaml exec app php bin/console doctrine:database:create

Supprimer la base

docker compose -f compose.dev.yaml exec app php bin/console doctrine:database:drop --force

Générer une migration

docker compose -f compose.dev.yaml exec app php bin/console make:migration

Exécuter les migrations

docker compose -f compose.dev.yaml exec app php bin/console doctrine:migrations:migrate




🌱 Chargement des Fixtures (FakerPHP)

Les données de démonstration utilisent FakerPHP pour générer automatiquement :

    Utilisateurs réalistes

    Trajets

    Villes

    Jeux de données cohérents pour les tests

docker compose -f compose.dev.yaml exec app php bin/console doctrine:fixtures:load




⚠️ Cette commande purge la base avant injection.
🧹 Vider le cache Symfony

docker compose -f compose.dev.yaml exec app php bin/console cache:clear




🔎 Recherche de covoiturages

La recherche fonctionne via :

    Requête AJAX côté frontend

    Contrôleur Symfony

    Repositories Doctrine

    Interrogation réelle de MariaDB

    Retour JSON dynamique




🏗️ Architecture du compose.dev.yaml
Services

    database : MariaDB 10.6

    app : PHP 8.2 + Apache + Symfony

    adminer : interface SQL web

Volumes

    ./app:/var/www/html → hot reload

    db_data → persistance SQL




🌐 Environnement de production

Le fichier compose.yaml utilise l’image publiée sur GHCR :

app:
  image: ghcr.io/bhhdev/ecoride:latest

Lancer en production

docker compose up -d

Application :
👉 http://51.38.191.60:2000
🔐 Base de données PROD

MariaDB n’expose aucun port externe.
Accessible uniquement depuis le réseau Docker.


🐳 Workflow Docker : build & push GHCR
Construire l’image

docker build -t ghcr.io/bhhdev/ecoride:latest .

Se connecter à GHCR

echo TOKEN | docker login ghcr.io -u bhhdev --password-stdin

Pousser l’image

docker push ghcr.io/bhhdev/ecoride:latest




📁 Structure du projet

/app
 ├── src
 │   ├── Entity
 │   ├── Repository
 │   ├── Controller
 │   └── DataFixtures
 ├── config
 ├── public
 ├── templates
 ├── migrations
 ├── Dockerfile
compose.yaml
compose.dev.yaml



🔁 Workflow développeur (remise à zéro complète)
1. Démarrer Docker

docker compose -f compose.dev.yaml up -d --build

2. Supprimer la base existante

docker compose -f compose.dev.yaml exec app php bin/console doctrine:database:drop --force --if-exists

3. Recréer la base

docker compose -f compose.dev.yaml exec app php bin/console doctrine:database:create

4. Appliquer les migrations

docker compose -f compose.dev.yaml exec app php bin/console doctrine:migrations:migrate

5. Charger les fixtures

docker compose -f compose.dev.yaml exec app php bin/console doctrine:fixtures:load

6. Nettoyer le cache

docker compose -f compose.dev.yaml exec app php bin/console cache:clear




📌 Cycle classique de développement
Action	Commande
Créer / modifier une entité	make:entity
Créer migration	make:migration
Mettre à jour la BDD	doctrine:migrations:migrate
Recharger données	doctrine:fixtures:load
Vider cache	cache:clear
Logs conteneurs	docker compose logs -f



🛠️ Technologies utilisées

    Symfony 7.3

    Doctrine ORM

    MariaDB 10.6

    FakerPHP

    PHP 8.2

    Twig

    Bootstrap / SCSS

    Docker / Docker Compose

    Adminer

    GHCR



GHCR : ghcr.io/bhhdev
- Base de données MariaDB 10.6
- Conteneurisation complète via Docker & Docker Compose
- Environnements DEV et PROD séparés
- Administration SQL via Adminer
- Déploiement automatisé via GHCR

---

## 🖥️ Environnement de développement

### 🔧 Prérequis
- Linux Ubuntu 24.04.3 LTS 
- Docker Desktop  
- VS Code  
- Symfony CLI  
- Composer  
- Git

---

## 📦 Lancement de l'environnement de développement

docker compose -f compose.dev.yaml up --build
````

L’application sera alors disponible sur :
👉 [http://localhost:8080](http://localhost:8080)

Adminer :
👉 [http://localhost:8899](http://localhost:8899)

Base de données DEV :

| Paramètre | Valeur   |
| --------- | -------- |
| Host      | database |
| Port      | 3306     |
| User      | bhhdev   |
| Pass      | bhhdev   |
| DB        | ecoride  |

---

## 🏗️ Architecture du compose.dev.yaml

### Services :

* **database** : MariaDB 10.6
* **app** : conteneur PHP/Apache construit depuis `app/Dockerfile`
* **adminer** : interface graphique SQL

### Volumes :

* `./app:/var/www/html` (hot reload)
* `db_data` (persistance SQL)

---

## 🌐 Environnement de production

Le fichier `compose.yaml` pointe vers l’image Docker publiée sur GHCR :

```yaml
app:
  image: ghcr.io/bhhdev/ecoride:latest
```

### Lancer en PROD :


docker compose up -d
```

Application en production :
👉 [http://51.38.191.60:2000](http://51.38.191.60:2000)

---

## 🗄️ Base de données PROD

En production, MariaDB n’expose aucun port externe → sécurité renforcée.
Les accès se font uniquement **depuis l’intérieur du réseau Docker**.

---

## 🐳 Docker : workflow de build et push

### Construire l’image :

docker build -t ghcr.io/bhhdev/ecoride:latest .

```

### Se connecter à GHCR :


echo TOKEN | docker login ghcr.io -u bhhdev --password-stdin

```

### Pousser l’image :


docker push ghcr.io/bhhdev/ecoride:latest

---

## 📁 Structure du projet

```
/app
  ├── src
  ├── config
  ├── public
  ├── vendor
  ├── Dockerfile
compose.yaml
compose.dev.yaml

---

## 🛠️ Technologies utilisées

* Symfony 7.3
* PHP 8.2 (FPM/Apache)
* MariaDB 10.6
* Docker / Docker Compose
* Adminer
* GHCR
* VS Code
* WSL2 / Ubuntu 24.04 LTS

---

## 📄 Licence

Projet public — Tous droits réservés.

---
## ✨ Auteur

**BhhDev**  
GitHub : [https://github.com/bhhdev](https://github.com/bhhdev)  
GHCR : ghcr.io/bhhdev



