# 00 — La commande client du lundi matin

Vous êtes **prestataire individuel** pour un vrai type d'organisation fictive : festival, FabLab ou escape game. Vous devez livrer vendredi une application que le client pourrait comprendre et essayer.

## Avant toute ligne de code

1. Lire les [trois sujets](../README.md).
2. Choisir celui qui vous donne envie de montrer une vraie situation.
3. Réserver les 3 règles contractuelles et les 3 extensions avec le [modèle de choix](../templates/CHOIX_REGLES.md).
4. Créer votre dépôt Git individuel et un backlog.
5. Rédiger un cahier des charges **personnalisé**, pas une copie des pages du dépôt.

## La scène de démonstration d'abord

Écrivez un petit scénario :

> « Je suis [acteur], je veux [action]. Comme [contrainte métier], l'application doit [résultat]. »

Il vous guidera pour choisir les entités, les écrans et les tests.

## Livrables de conception lundi

- acteurs et cas d'usage ;
- MCD/MLD et schéma relationnel initial ;
- architecture MVC/Slim ;
- maquette de l'accueil, tableau de bord, fiche métier, formulaire et cas de refus ;
- tableau du contrat API initial ;
- dépôt avec `README.md`, `docs/`, `docs/maquettes/`, `database/` et backlog.

Utilisez le [starter](../starter-kit/README.md) pour un premier trajet BDD → Slim → HTML/JSON. Ne le livrez pas sans authentification ni protections complémentaires.

## Première victoire du lundi soir

**Une donnée créée ou lue en base apparaît dans le navigateur, et vous pouvez expliquer son parcours dans MVC.** C'est plus important que d'avoir douze pages HTML vides.

## Puis chaque jour

Suivez le [GPS de la semaine](25-parcours-et-jalons.md) et vérifiez les jalons. Si vous travaillez chez vous, commencez par le premier élément manquant du chemin critique.

## Définition de « terminé »

Une fonctionnalité doit être **démontrable, contrôlée côté serveur, testée, persistée, intégrée à Git et explicable**. Un bouton qui semble fonctionner dans un seul navigateur ne suffit pas.
