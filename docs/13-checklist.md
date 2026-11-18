# 13 — Checklist de fin de semaine

## Besoin et conception
- [ ] sujet et client fictif compris
- [ ] triplet contractuel unique, 2 familles et 1 règle intermédiaire ou avancée
- [ ] **3 règles contractuelles** définies avec leurs scénarios
- [ ] **3 extensions** choisies et priorisées (pas nécessairement toutes réalisées)
- [ ] maquette validée
- [ ] MCD/MLD, architecture, cas d'usage
- [ ] jeu de données de démonstration
- [ ] objets SQL avancés planifiés sur un besoin réel, avec fichiers versionnés

## Application
- [ ] partie publique utile
- [ ] authentification et déconnexion réelles
- [ ] rôles et autorisations **serveur**
- [ ] tableau de bord et parcours métier complet
- [ ] base relationnelle, liens et contraintes
- [ ] recherche/filtre
- [ ] 3 règles contractuelles terminées et démontrables
- [ ] extension n°1 si le temps le permet
- [ ] traces d'incidents ou décisions pertinentes
- [ ] **1 trigger pertinent minimum**, déclenché et vérifié
- [ ] **1 procédure stockée minimum**, appelée depuis un repository PHP
- [ ] **2 vues SQL minimum**, chacune utilisée depuis le code PHP

## Contrat API
- [ ] GET collection : tableau JSON
- [ ] GET détail : 200 ou 404
- [ ] POST JSON métier : 201 + Location
- [ ] validation 400 / 415 / 422 quand pertinente
- [ ] documentation méthode, URL, requête, réponse, erreurs, droits
- [ ] mêmes règles entre HTML et JSON

## Tests et sécurité
- [ ] scénario positif et refus pour chacune des 3 règles
- [ ] cas limite si pertinent
- [ ] test rôle/accès direct
- [ ] test CSRF formulaire
- [ ] SQL paramétré
- [ ] HTML échappé et entrées typées
- [ ] mot de passe haché et secrets hors Git
- [ ] recette écrite
- [ ] tests du trigger (effet et absence d'effet/refus si pertinent), de la procédure et des deux vues

## Maintenance
- [ ] issue d'évolution et impact avant code
- [ ] évolution terminée et testée
- [ ] incident réel reproduit/analysé
- [ ] correction + test de non-régression
- [ ] rapport d'incident

## Livraison
- [ ] installation/documentation
- [ ] scripts SQL ordonnés ou migrations dans Git, et reconstruction testée sur base vierge
- [ ] sauvegarde ET test de restauration BDD
- [ ] déploiement ou environnement démontrable
- [ ] release Git
- [ ] preuve des compétences réellement mobilisées
- [ ] [démonstration personnelle](../templates/DEMONSTRATION.md) préparée
