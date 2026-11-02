# BTS SIO SLAM — Semaine intensive « Projet Web »

**Du lundi 23 au vendredi 27 novembre 2026 — 6 étudiants, 3 sujets, 6 réalisations individuelles possibles.**

Vous ne réalisez pas un exercice PHP déguisé : vous répondez à une **commande professionnelle fictive**, avec des utilisateurs, un problème concret, des règles métier qui changent réellement le comportement du logiciel et une livraison défendable au BTS.

## Votre mission : choisissez votre univers

| Sujet | Client et défi | Ce qui peut être amusant |
|---|---|---|
| [**Backstage**](sujets/backstage.md) | festival associatif : bénévoles, activités, matériel, incidents | sauver le programme avant l'ouverture |
| [**RepairLab**](sujets/repairlab.md) | FabLab : équipements, réservations et interventions | décider si une machine peut être utilisée |
| [**EscapeOps**](sujets/escapeops.md) | escape game : salles, sessions et exploitation | gérer la crise juste avant l'arrivée des joueurs |

Chaque sujet contient un **socle métier précis** et **10 règles personnalisables**.

### La personnalisation

Vous réservez **3 règles contractuelles à développer et démontrer** et **3 extensions choisies et priorisées**. Le triplet contractuel est unique pour un sujet donné. Une extension terminée est un objectif appréciable, mais **le socle, les trois contractuelles, les tests et la livraison passent avant**. Consultez la [procédure de choix](docs/03-selection-regles.md).

## Démarrage — votre chemin le plus court

1. [Lire le brief du lundi](docs/00-demarrage.md).
2. [Choisir votre combinaison](docs/03-selection-regles.md) et une scène de démo qui vous motive.
3. [Créer les maquettes](docs/04-maquettes.md) et le modèle de données.
4. [Démarrer le starter Slim + Medoo](starter-kit/README.md) pour comprendre les couches.
5. [Avancer par jalons du lundi au vendredi](docs/25-parcours-et-jalons.md).
6. [Écrire les tests et préparer votre démonstration](docs/26-tests-et-demonstration.md).
7. [Constituer vos preuves BTS](docs/10-preuves-bts.md).

### Vous êtes perdu ou en avance ?

- [Chronologie avec feux vert/orange/rouge et travail à la maison](docs/25-parcours-et-jalons.md)
- [Dépannage technique](docs/22-depannage-technique.md)
- [Bonnes pratiques et tests](docs/07-tests-securite.md)
- [Bonus pertinents](docs/12-bonus.md)
- [Checklist finale](docs/13-checklist.md)

## Ce que vous connaissez déjà

Les quatre cours ont été utilisés pour calibrer ce projet. [**Table de correspondance cours → réalisation (pages précises)**](docs/24-ponts-avec-les-cours.md).

- PHP interactif : GET/POST, formulaires, sessions, cookies, CSRF, PRG.
- Données persistantes : SQL, PDO, CRUD, contraintes, jointures, transactions, sécurité.
- MVC/Slim : routeur, modèle, contrôleur, repository, vue, Composer, PSR-7.
- REST : ressources, JSON, méthodes, statuts, Richardson, contrat et tests.

**Medoo est le complément documentaire** proposé par le dépôt pour appliquer le PDO déjà appris. Vous n'avez pas à apprendre un frontend JS complet, une architecture microservices ou HATEOAS pour réussir.

## Kit technique & documentation

- [Starter exécutable](starter-kit/README.md)
- [Cadre technique commun](docs/01-cadre-technique.md)
- [Slim 4 pratique](docs/17-slim-pratique.md)
- [Medoo pratique](docs/18-medoo-pratique.md)
- [Slim + Medoo ensemble](docs/19-slim-medoo-ensemble.md)
- [Recettes de code](docs/20-recettes-code.md)
- [Ressources officielles](docs/21-ressources-externes.md)
- [Étendre le starter](docs/23-tutoriel-etendre-starter.md)
- [API REST](docs/06-api-rest.md)

Le trajet métier à savoir expliquer :

```text
HTTP → Slim → Controller → domaine / Service → Repository → Medoo/PDO → SQL
                               │
                               └── vue HTML ou réponse API JSON
```

## Votre livraison

Un dépôt personnel propre, des maquettes, un MCD/MLD, une application sécurisée, une base et son jeu d'essai, une petite API, **3 règles testées**, une évolution et un incident traités, une recette, une documentation de déploiement et une démonstration personnelle.

La [grille E4/E5](docs/14-correspondance-bts.md) aide à identifier les **preuves possibles**, sans attribuer automatiquement une compétence parce qu'une fonctionnalité existe.

**La règle d'or : vous devez pouvoir expliquer et démontrer personnellement ce que votre logiciel fait — surtout quand il refuse une action.**
