# 08 — Déploiement

Une réalisation professionnelle doit pouvoir être montrée dans un état opérationnel.

## Livrables de déploiement

Créez `docs/deploiement.md` contenant :

- prérequis ;
- variables d’environnement ;
- installation des dépendances ;
- création de la base ;
- migration ou import initial ;
- lancement ;
- procédure de mise à jour ;
- procédure de sauvegarde ;
- procédure de restauration.

## Environnements

Distinguez :
- développement ;
- production.

Les secrets doivent être fournis par l’environnement et jamais versionnés.

## Base de données

Avant vendredi :
1. réaliser une sauvegarde ;
2. supprimer ou utiliser une base vierge de test ;
3. restaurer la sauvegarde ;
4. vérifier l’application après restauration.

Documentez le test.

## Vérification finale

À partir d’un poste ou environnement propre, vérifiez que la documentation permet réellement de lancer ou d’accéder au service.

## Preuve

Conservez :
- URL de production si disponible ;
- capture de l’application ;
- version/release déployée ;
- date de déploiement ;
- procédure utilisée.
