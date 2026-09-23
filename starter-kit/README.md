# Starter Kit Slim + Medoo

Ce dossier contient un **exemple minimal mais structuré** destiné à être compris, copié puis adapté.

Il montre volontairement le chemin complet :

```text
requête HTTP
   ↓
route Slim
   ↓
contrôleur
   ↓
service métier
   ↓
repository
   ↓
Medoo
   ↓
MySQL / MariaDB
```

Le kit ne contient volontairement **ni authentification complète, ni règles métier de vos sujets**. Ce travail vous appartient.

## 1. Prérequis

- PHP 8.2+
- Composer
- MySQL ou MariaDB
- extensions PHP PDO et pdo_mysql

## 2. Copier le kit

Copiez le dossier dans votre propre dépôt puis renommez/complétez ce qui doit l'être.

## 3. Installer

```bash
composer install
```

Copiez ensuite le fichier d'environnement :

### Linux / macOS

```bash
cp .env.example .env
```

### Windows PowerShell

```powershell
Copy-Item .env.example .env
```

Adaptez les valeurs de connexion.

## 4. Créer la base

Créez une base `bts_web`, puis importez :

1. `database/schema.sql`
2. `database/seed.sql`

## 5. Lancer

```bash
composer serve
```

Puis ouvrez :

- http://127.0.0.1:8080/
- http://127.0.0.1:8080/hello/Ada
- http://127.0.0.1:8080/api/health
- http://127.0.0.1:8080/api/equipment

## 6. Tester l'API

### Lire

```bash
curl http://127.0.0.1:8080/api/equipment
```

### Créer

```bash
curl -X POST http://127.0.0.1:8080/api/equipment \
  -H "Content-Type: application/json" \
  -d '{"name":"Oscilloscope","status":"AVAILABLE"}'
```

## 7. Ce qu'il faut comprendre avant de poursuivre

Vous devez savoir expliquer :

- pourquoi toutes les requêtes arrivent dans `public/index.php` ;
- ce qu'est une route Slim ;
- la différence entre contrôleur, service et repository ;
- où Medoo intervient ;
- pourquoi la validation métier ne doit pas être écrite dans la vue ;
- pourquoi les paramètres de connexion sont dans `.env` ;
- comment une réponse JSON est construite.

## 8. À adapter immédiatement dans votre projet

- namespace / nom du projet ;
- entités ;
- tables ;
- repositories ;
- services ;
- contrôleurs ;
- routes ;
- vues ;
- règles métier ;
- authentification et habilitations ;
- tests.

Ne transformez pas ce starter en architecture figée : **il sert à comprendre le démarrage, pas à vous empêcher de concevoir votre solution.**
