# 11 — Livrables attendus

## Livrables techniques

- dépôt Git complet ;
- application fonctionnelle ;
- base de données ;
- scripts SQL ou migrations **versionnés** permettant de reconstruire le schéma, **au moins deux vues consommées par le code, une procédure stockée appelée par un repository PHP et un trigger métier effectivement déclenché** ;
- API REST ;
- tests, dont essais ciblés des vues, de la procédure et du trigger (cas normal / effet / refus selon le mécanisme) ;
- release finale ;
- application déployée lorsque l’environnement le permet.

## Livrables de conception

- cahier des charges personnalisé ;
- backlog ;
- choix des règles ;
- cas d’usage ;
- modèle de données ;
- schéma relationnel ;
- maquettes ;
- décisions d’architecture importantes.

## Livrables qualité

- plan ou rapport de tests ;
- recette ;
- preuve de non-régression ;
- rapport d’incident ;
- éléments de sécurité ;
- résultat du test sauvegarde/restauration.

## Documentation

- README ;
- installation ;
- utilisation ;
- API ;
- déploiement ;
- comptes de démonstration sans secret réel ;
- limites connues.

## Livraison finale

Le vendredi, créez une release `v1.0.0` ou équivalente.

La release doit correspondre exactement à la version démontrée.

Votre README doit permettre à une personne extérieure de comprendre :
- ce que fait le produit ;
- comment l’installer ;
- comment l’utiliser ;
- comment recréer la base à partir des scripts versionnés et vérifier les objets SQL avancés ;
- quelles règles ont été choisies ;
- où trouver les preuves.
