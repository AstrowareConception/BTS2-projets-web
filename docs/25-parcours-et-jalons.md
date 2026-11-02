# 25 — Le parcours réel : dans quel ordre travailler ?

La semaine est courte. **Il faut un produit testable chaque soir**, pas un immense ensemble de fichiers en chantier.

## Règle de méthode : une tranche verticale

Commencez par un parcours traversant `HTML → Slim → contrôleur → service/modèle → repository → BDD`. Puis ajoutez une représentation JSON exploitant **la même logique métier**.

Ne développez pas les 10 règles « en même temps ».

## Lundi — Une conception montrable et une première donnée

**Matin :** choix du sujet, réservation unique des 3 contractuelles + 3 extensions, lecture du contexte client, acteurs, parcours de démo, maquettes, MCD/MLD et contrat API initial.  
**Après-midi :** dépôt, installation du starter, schéma SQL et données fictives, premier CRUD vertical simple, vérification du lancement.

**Fin lundi :** on peut montrer une page issue de la BDD, la maquette et les règles choisies ; le code est poussé.

🟢 API ou route HTML + BDD en place, dossier conçu. 🟠 serveur fonctionnel sans premier parcours complet. 🔴 aucune donnée persistée ni route exploitable.

## Mardi — Une application métier utilisable

**Matin :** connexion/déconnexion, rôles, sessions et protections de formulaires, structure des repositories.  
**Après-midi :** gestion des principales entités et workflow de base, recherche/filtres, un tableau de bord crédible, premiers tests de recette.

**Fin mardi :** un utilisateur peut réaliser **un parcours métier entier** avec le bon rôle et la bonne donnée persistante.

🟢 login/roles + vrai workflow. 🟠 parcours partiellement terminé. 🔴 seulement des formulaires isolés ou de fausses données.

## Mercredi — Les trois règles contractuelles

**Matin :** implémenter les règles **l'une après l'autre de bout en bout**, en commençant par la plus risquée ; prouver succès et refus.  
**Après-midi :** compléter la petite API JSON avec son contrat et ses erreurs, recette rapide des règles ; recevoir un **ticket d'évolution client cadré**, l'analyser avant toute modification.

**Fin mercredi :** trois règles opérationnelles, un endpoint API de collection + détail + écriture, analyse d'impact de l'évolution.

🟢 3 règles + API. 🟠 2 règles + socle stable. 🔴 moins de 2 règles ou auth/BDD défaillantes.

## Jeudi — Le logiciel réagit au changement

**Matin :** évolution courte attribuée, mise à jour de la modélisation si nécessaire et tests de non-régression.  
**Après-midi :** incident réaliste choisi parmi des parcours effectivement présents, reproduction, diagnostic, correction, test et rapport. Selon le temps : première extension.

**Fin jeudi :** l'évolution et l'incident sont traçables ; les trois règles demeurent stables.

🟢 évolution + correctif + test. 🟠 correctif à finaliser. 🔴 régression majeure ou règle contractuelle toujours absente.

## Vendredi — Livrer, ne plus ajouter

**Matin :** figer le périmètre, recette, sécurité, sauvegarde/restauration BDD, déploiement et correction critique.  
**Après-midi :** documentation, screenshots de preuve, release Git et **démonstration guidée de 5–7 minutes**.

**Fin vendredi :** autre personne capable de lancer, comprendre et vérifier le projet.

## Travailler chez soi : quel objectif ?

- 🔴 **Rattrapage :** résoudre le premier maillon cassé : démarrage → données → auth → métier → règles. Pas de bonus.
- 🟠 **Consolidation :** terminer le jalon en cours, écrire les deux tests d'une règle et pousser.
- 🟢 **Approfondissement :** extension n°1, automatisation de tests, CI, OpenAPI, amélioration UX.

Un objectif du soir doit être vérifiable, par exemple « le responsable peut résoudre un incident et l'API renvoie 404 sur un ID inconnu », plutôt que « avancer PHP ».

## Les trois vrais engagements

- **3 règles contractuelles :** exigées, testées, démontrées.
- **3 extensions réservées :** backlog personnel ; tenter d'en réaliser **au moins une** après stabilisation, sans sacrifier les trois contractuelles. Les trois ne sont pas une nouvelle obligation cachée.
- **Une évolution courte + un incident :** imposés après la première version, et adaptés aux fonctionnalités réellement présentes.

Une belle application plus modeste, maîtrisée, est préférable à un assemblage inachevé.
