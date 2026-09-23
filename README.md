# BTS SIO SLAM — Semaine intensive « Projet Web »

**Dates : du lundi 23 au vendredi 27 novembre 2026**  
**Format : projet individuel**  
**Objectif : produire une réalisation professionnelle Web exploitable dans le portfolio et potentiellement présentable à l’épreuve pratique/orale.**

Cette semaine n’est pas un TP géant. Vous allez travailler comme sur une petite mission professionnelle : analyse d’un besoin, conception, maquettage, développement, base de données, règles métier, API, tests, sécurité, gestion de versions, évolution, maintenance, documentation et livraison.

## Votre mission

1. Choisissez **un sujet parmi les trois proposés** :
   - [Backstage — Festival & événementiel](sujets/backstage.md)
   - [RepairLab — Repair Café / FabLab](sujets/repairlab.md)
   - [EscapeOps — Escape game](sujets/escapeops.md)
2. Étudiez les **10 règles métier** de votre sujet.
3. Réservez une combinaison unique de :
   - **3 règles contractuelles obligatoires** ;
   - **3 règles d’extension**.
4. Produisez une **maquette validée avant le développement des écrans**.
5. Construisez et déployez votre application.
6. Traitez une évolution et un incident en cours de semaine.
7. Constituez vos preuves techniques et votre documentation.

## Kit technique

Vous avez déjà étudié la théorie. Cette section sert de **référence rapide pendant le projet**.

- [Starter Kit exécutable Slim + Medoo](starter-kit/README.md)
- [17 — Slim 4 : guide pratique](docs/17-slim-pratique.md)
- [18 — Medoo : guide pratique](docs/18-medoo-pratique.md)
- [19 — Slim + Medoo ensemble](docs/19-slim-medoo-ensemble.md)
- [20 — Recettes de code](docs/20-recettes-code.md)
- [21 — Ressources externes sélectionnées](docs/21-ressources-externes.md)
- [22 — Dépannage technique](docs/22-depannage-technique.md)
- [23 — Tutoriel : étendre le starter](docs/23-tutoriel-etendre-starter.md)

Le starter illustre volontairement :

```text
Route Slim
   ↓
Controller
   ↓
Service
   ↓
Repository
   ↓
Medoo
   ↓
MySQL / MariaDB
```

Il contient aussi une vue HTML, des routes Web, une petite API JSON, un schéma SQL et des données de démonstration. **Il doit être adapté, pas cloné sans compréhension.**

## Démarrage rapide

- [00 — Démarrage](docs/00-demarrage.md)
- [01 — Cadre technique commun](docs/01-cadre-technique.md)
- [02 — Planning complet](docs/02-planning.md)
- [03 — Choix des règles métier](docs/03-selection-regles.md)
- [04 — Maquettes](docs/04-maquettes.md)
- [05 — Git & gestion de projet](docs/05-git-projet.md)
- [06 — API REST](docs/06-api-rest.md)
- [07 — Tests, qualité & sécurité](docs/07-tests-securite.md)
- [08 — Déploiement](docs/08-deploiement.md)
- [09 — Évolution & maintenance](docs/09-evolution-maintenance.md)
- [10 — Preuves BTS](docs/10-preuves-bts.md)
- [11 — Livrables](docs/11-livrables.md)
- [12 — Bonus](docs/12-bonus.md)
- [13 — Checklist finale](docs/13-checklist.md)
- [14 — Correspondance BTS](docs/14-correspondance-bts.md)
- [15 — Rituel quotidien](docs/15-rituel-quotidien.md)
- [16 — Guide d’autonomie](docs/16-guide-autonomie.md)

## Philosophie

Le socle technique est commun, mais **aucune réalisation ne doit être identique à une autre**. Deux étudiants ayant choisi le même sujet doivent obtenir des applications différentes par leurs règles métier, leurs choix d’interface, leur modélisation, leur organisation interne et leurs extensions.

Le but n’est pas de « faire beaucoup de pages ». Le but est de produire une application cohérente, maîtrisée, testée, sécurisée et défendable à l’oral.
