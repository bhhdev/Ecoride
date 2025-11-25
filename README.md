# EcoRide — Plateforme Symfony 7 (Docker)

Ce projet est une application Symfony 7 conteneurisée avec Docker, utilisant MariaDB et une architecture adaptée aux environnements **DEV** et **PROD**.  
Le code est versionné sur GitHub et les images Docker sont publiées via **GitHub Container Registry (GHCR)**.

---

## 🚀 Fonctionnalités principales
- Backend Symfony 7.3
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

```bash
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

```bash
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

```bash
docker build -t ghcr.io/bhhdev/ecoride:latest .
```

### Se connecter à GHCR :

```bash
echo TOKEN | docker login ghcr.io -u bhhdev --password-stdin
```

### Pousser l’image :

```bash
docker push ghcr.io/bhhdev/ecoride:latest
```

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
```

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



