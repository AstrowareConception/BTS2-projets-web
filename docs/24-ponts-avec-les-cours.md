# 24 — Mobiliser exactement ce que vous avez étudié

Ce projet s'appuie sur **quatre supports de cours reçus avant la semaine du 23 au 27 novembre 2026**. Vous pouvez revenir à une page précise au lieu de rechercher au hasard sur Internet.

> Les renvois ci-dessous indiquent la **pagination des PDF de cours**, pas les numéros d'un support à remettre au jury. Les PDF ne sont pas dupliqués ici : utilisez les versions déjà distribuées par l'enseignant.

| Besoin concret du projet | Cours / pages à revoir | Preuve attendue |
|---|---|---|
| GET, POST, champs, données malformées | **PHP interactif**, pp. 8–34 | recherche GET, formulaire POST dont les types sont vérifiés |
| Validation, normalisation, XSS | **PHP interactif**, pp. 35–49 | messages compréhensibles et HTML échappé |
| PRG, 303, cookies, sessions, CSRF | **PHP interactif**, pp. 50–87 | action POST sans doublon, session et formulaire protégé |
| Schéma relationnel, clés, contraintes | **Données persistantes**, pp. 9–23 | MCD/MLD, schéma SQL, contraintes et jeu d'essai |
| PDO, requêtes paramétrées, jointures, pagination | **Données persistantes**, pp. 24–56 | repository et requêtes de recherche et statistiques |
| CRUD, suppression, intégrité | **Données persistantes**, pp. 57–75 | parcours complet et contrôles de droits |
| Transactions, concurrence, comptes | **Données persistantes**, pp. 76–91 | réservation/stock atomique si la règle l'exige, mot de passe haché |
| Architecture et tests | **Données persistantes**, pp. 92–98 | services/repositories, recette et sécurité |
| MVC, modèle, vue, contrôleur | **MVC/Slim 4**, pp. 12–16 | responsabilités justifiées |
| Slim, PSR-7, routage, Composer, PSR-4 | **MVC/Slim 4**, pp. 17–26 | un front controller, routes, composants instanciés |
| Modèle et repository | **MVC/Slim 4**, pp. 27–36 | règles de domaine isolées des requêtes |
| HTML, formulaires, CSRF, 303 | **MVC/Slim 4**, pp. 37–54 | HTML sans SQL et traitement POST/redirect |
| Erreurs, tests et sécurité | **MVC/Slim 4**, pp. 55–69 | réponse correcte et test correspondant |
| Ressource, JSON, verbes et statuts | **REST/Slim 4**, pp. 10–23 | contrat HTTP lisible et erreurs 400/415/422 |
| Contraintes REST, Richardson, HATEOAS | **REST/Slim 4**, pp. 24–42 | API cohérente principalement au niveau 2 |
| Contrat, exemples, OpenAPI | **REST/Slim 4**, pp. 43–51 | tableau méthodes/URI/statuts/corps, OpenAPI en approfondissement |
| Contrôleur JSON partageant le domaine | **REST/Slim 4**, pp. 52–67 | HTML et JSON utilisant les mêmes services |
| PUT/PATCH/DELETE, qualité | **REST/Slim 4**, pp. 68–89 | mise à jour d'une ressource et tests HTTP |

## Ce que vos cours permettent déjà

Il n'est pas demandé de découvrir un nouveau framework frontend, une architecture microservices ou OAuth2. **Slim 4 + MVC + modèles/services + repository + BDD + HTML/JSON** suffisent à produire une RP solide.

Le cours MVC montre un exemple **PDO/SQLite** ; le cours données persistantes montre **PDO/MySQL**. Le starter pédagogique de ce dépôt propose **Medoo**, bibliothèque au-dessus de PDO : **ce n'est pas une notion développée dans ces quatre PDF**. Il faut donc apprendre la syntaxe de Medoo grâce aux [guides du dépôt](18-medoo-pratique.md), **sans oublier ce que l'on sait du SQL, des transactions et de la validation**. Vous pouvez justifier l'utilisation de PDO directement dans un repository lorsque cela rend une requête ou une transaction plus compréhensible.

## Les trois frontières à ne jamais mélanger

- **Validation métier :** modèle ou service. Exemple : impossible de publier une activité sans responsable.
- **Persistance :** repository + PDO/Medoo. Exemple : récupérer les affectations d'un bénévole.
- **Transport et présentation :** contrôleurs et vues HTML / contrôleur API JSON. Exemple : 422, 404, 303, 201.

Une nouvelle exigence métier ne doit pas forcer la duplication de sa logique entre le site HTML et l'API JSON.

## Ce qui appartient à la découverte ou au bonus

- HATEOAS complet : notion étudiée, **pas une exigence de livraison**.
- OpenAPI en YAML, CI poussée, PHPUnit avancé, scans statiques : **approfondissements utiles**, non prérequis à la réussite du parcours métier.
- Medoo : documentation applicative à exploiter ; **Slim reste le micro-framework HTTP**, Medoo reste la couche d'accès aux données.

## Un test oral simple

Choisissez une règle et expliquez sans ouvrir tout votre code :

1. quelle action utilisateur la déclenche ;
2. comment Slim route la requête ;
3. où les données sont validées ;
4. où la règle est prise ;
5. quel repository est appelé ;
6. pourquoi la réponse est 200, 201, 303, 403, 404, 409 ou 422 ;
7. comment le cas d'échec a été testé.

Si vous répondez clairement, vous démontrez l'assimilation de vos cours.
