# 01 — Cadre technique commun : une RP Web maîtrisée

Trois sujets, **un même cadre d'apprentissage**, mais six réalisations individuelles réellement personnalisées.

## Stack

- PHP 8.2+, Composer et autoload PSR-4 ;
- Slim 4 pour routes, objets HTTP PSR-7 et middlewares ;
- architecture MVC et, lorsque nécessaire, service métier et repository ;
- MySQL/MariaDB et **PDO/Medoo** (Medoo est un composant léger **au-dessus de PDO**, pas un framework MVC) ;
- HTML/CSS et formulaires ; JavaScript facultatif ;
- petite API JSON indépendante des vues HTML ;
- Git, tickets, tests, documentation et livraison.

**Aucun framework frontend JavaScript n'est imposé.** Ne commencez pas React/Vue pour la première fois pendant cette semaine.

## Les dix exigences fonctionnelles du socle

1. Une partie publique **utile** à l'organisation cliente, pas un simple écran de bienvenue.
2. Une authentification réelle par compte, avec session et déconnexion.
3. Trois rôles aux capacités distinctes, appliquées **côté serveur**.
4. Un tableau de bord correspondant à une décision du métier.
5. Des entités relationnelles et un schéma de base cohérent.
6. Au moins une vraie relation N–N lorsque justifiée.
7. Un parcours métier complet, de l'action à sa persistance.
8. Une recherche ou un filtre utile et un état « aucun résultat ».
9. Une petite API de liste/détail/écriture partageant les règles du site.
10. Une trace métier pertinente (incident, affectation, changement de statut...).

## Trois règles choisies et réellement exécutées

Les 10 règles de chaque fiche sont des **options de personnalisation**, pas 10 développements obligatoires. Seules les **3 contractuelles** doivent toutes être terminées ; les 3 extensions définissent le backlog supplémentaire. L'évolution du jeudi matin est un ticket distinct de taille contrôlée.

## Les responsabilités

```text
Entrée HTTP
    ↓
Route Slim / Controller
    ↓
Modèle et Service métier (invariants, décisions)
    ↓
Repository (Medoo/PDO)
    ↓
Base SQL

Vue PHP = HTML échappé
API = contrat JSON et statuts HTTP cohérents
```

Une règle importante s'applique aussi bien si l'utilisateur passe par un formulaire HTML que si un client appelle l'API. Les vues ne font ni SQL ni décisions de droit.

## Données et qualité

Préparez un MCD/MLD, des PK/FK, des contraintes, des requêtes paramétrées et un jeu de test. Utilisez jointures, agrégats ou transactions quand le besoin métier les justifie. Une base de **6 à 10 tables utiles** est une taille raisonnable, pas un quota.

La sauvegarde/restauration, le contrôle des droits, le CSRF des formulaires authentifiés, le hachage des mots de passe, la validation et la non-régression sont des **exigences de qualité**.

## Le starter

Le [starter](../starter-kit/README.md) montre une version volontairement réduite, avec un exemple d'accès SQL et deux représentations HTTP. Il **ne gère pas l'authentification réelle**, donc il n'est pas livrable en l'état.

## Les cours

Le dossier [24 — ponts avec les cours](24-ponts-avec-les-cours.md) relie chaque brique à des pages précises des quatre supports fournis.

## Ce qui est interdit

- code uniquement CRUD sans parcours métier ;
- règles seulement écrites dans JavaScript/HTML ;
- fausse authentification par bouton ;
- secrets dans Git ;
- données personnelles réelles dans les seeds ;
- suppression sensible par GET ;
- API disant toujours 200 ;
- production du vendredi sans tests ni documentation ;
- copier le travail d'un camarade ou un générateur sans pouvoir l'expliquer.
