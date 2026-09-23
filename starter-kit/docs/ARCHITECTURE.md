# Architecture du starter

## Vue d'ensemble

```text
public/index.php
      │
      ├── charge .env + settings
      ├── crée Slim
      ├── crée Medoo
      ├── câble Repository / Service / Controller
      │
      └── charge les routes
              │
              ▼
          Controller
              │
              ▼
            Service
              │
              ▼
          Repository
              │
              ▼
             Medoo
              │
              ▼
              SQL
```

## Pourquoi un Service ?

Le repository sait **lire et écrire les données**.

Le service sait **appliquer les règles métier**.

Exemple :
- Repository : « donne-moi les réservations qui se chevauchent ».
- Service : « si une réservation se chevauche, refuser la nouvelle réservation ».

Ne mettez pas vos règles importantes directement dans les routes ou les vues.

## Pourquoi un Repository ?

Le contrôleur ne doit pas connaître chaque détail de requête SQL/Medoo.

Cela rend :
- la lecture du code plus facile ;
- la logique métier plus claire ;
- les tests plus simples ;
- le changement d'accès aux données moins invasif.

## Pourquoi des fichiers de routes séparés ?

On distingue ici :
- `routes/web.php` : HTML / navigation utilisateur ;
- `routes/api.php` : JSON / échanges applicatifs.

Ce n'est pas obligatoire dans Slim, mais c'est lisible et adapté au projet.

## Ce qui manque volontairement

- authentification ;
- middleware d'autorisation ;
- CSRF ;
- logs applicatifs ;
- tests automatisés ;
- transactions métier complexes ;
- pagination.

Vous devez les ajouter selon votre projet.
