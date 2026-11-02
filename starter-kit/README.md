# Starter Slim 4 + Medoo : premier trajet de bout en bout

Ce starter est **un exemple pédagogique**, pas une solution prête pour la production.

```text
HTTP → Slim → Controller → EquipmentService → EquipmentRepository → Medoo/PDO → SQL
                    ├── HTML dans une vue PHP
                    └── JSON dans l'API
```

Le nom d'équipement est validé **une seule fois dans le service**, quel que soit le canal. Medoo est une bibliothèque d'accès SQL au-dessus de PDO ; Slim est le micro-framework HTTP.

## Préparer

Prérequis : PHP 8.2+, Composer, MySQL/MariaDB, extensions `pdo_mysql` et `mbstring`.

Depuis `starter-kit` :

```bash
composer install
```

Copiez `.env.example` en `.env` (PowerShell : `Copy-Item .env.example .env`) puis configurez votre accès SQL.

Créez la base `bts_web`, importez `database/schema.sql` puis `database/seed.sql`.

Démarrez :

```bash
composer serve
```

Consultez :
- http://127.0.0.1:8080/
- http://127.0.0.1:8080/hello/Ada
- http://127.0.0.1:8080/api/health
- http://127.0.0.1:8080/api/equipment

## Pourquoi ce petit exemple est intéressant

- `GET /` : le serveur rend du HTML avec des données SQL.
- `POST /equipment` : formulaire avec jeton anti-CSRF ; si valide, **303 See Other** vers GET ; sinon 403 ou 422.
- `GET /api/equipment` : renvoie un **tableau JSON**, y compris si vide.
- `GET /api/equipment/{id}` : 200 ou 404.
- `POST /api/equipment` : distingue **415** (média), **400** (JSON mal formé / non objet), **422** (règle métier), **201 + Location** (création).

Les routes API n'ouvrent pas de session PHP ; les routes HTML en utilisent une pour illustrer le CSRF.

## Vérifier à la main

```bash
curl -i http://127.0.0.1:8080/api/equipment

curl -i -X POST http://127.0.0.1:8080/api/equipment \
  -H "Content-Type: application/json" \
  -d '{"name":"Oscilloscope","status":"AVAILABLE"}'

curl -i -X POST http://127.0.0.1:8080/api/equipment \
  -H "Content-Type: application/json" \
  -d '{"name":" "}'

curl -i -X POST http://127.0.0.1:8080/api/equipment \
  -H "Content-Type: text/plain" \
  -d 'test'
```

## Tester automatiquement sans BDD

```bash
composer test
```

Le script `tests/http-input.php` vérifie quatre scénarios du **contrat JSON** (succès, 415, 400 malformé, 400 corps non objet). La CI GitHub Actions le lance également. Ces tests ne remplacent pas un test complet de réservation, de droits ou d'intégration SQL : **il vous appartient de les écrire dans votre réalisation**.

## Deux limites importantes

**Aucune authentification utilisateur n'est fournie.** Le formulaire HTML est protégé par un jeton CSRF mais reste public ; l'API d'écriture est également publique. Le starter ne doit **jamais être mis en production tel quel**.

Il ne contient pas vos règles métier, votre propre modèle de données, ni des tests de vos parcours. Ce travail est celui des étudiants.

## Pour l'adapter

1. Créez les classes du domaine de votre sujet.
2. Construisez le schéma relationnel et les données de test.
3. Remplacez le repository des équipements par vos repositories.
4. Portez les règles dans les modèles/services.
5. Conservez la séparation des routes HTML et JSON.
6. Ajoutez **authentification, autorisations, tests et déploiement**.
7. Vérifiez que votre propre code respecte les cours.

**Compléments :** [Slim](../docs/17-slim-pratique.md), [Medoo](../docs/18-medoo-pratique.md), [association des deux](../docs/19-slim-medoo-ensemble.md), [correspondance avec les cours](../docs/24-ponts-avec-les-cours.md).
