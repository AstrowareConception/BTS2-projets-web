# 03 — Personnalisez votre commande client

Chaque sujet propose **10 règles métier distinctes**, toutes réalisables depuis son **socle commun**, sans avoir besoin d'avoir sélectionné une autre règle.

## Deux engagements différents

**3 règles contractuelles** : vous vous engagez à les implémenter **entièrement**, avec démonstration, cas positif, cas négatif et vérification serveur.

**3 règles d'extension** : vous les réservez comme possibilités d'évolution dans votre backlog, par ordre de priorité. Essayez d'en livrer au moins une **si le socle est stable**, mais trois extensions ne doivent pas vous pousser à bâcler les contractuelles.

Vous devez également traiter le ticket d'évolution du mercredi et l'incident du jeudi. Leur portée sera **cadrée** pour rester faisable en une semaine.

## Comment choisir ?

Avant de réserver vos règles, posez-vous :

1. Quel **parcours utilisateur** vais-je démontrer vendredi ?
2. Quelles **données** seront nécessaires ?
3. Quel cas d'**échec** sera intéressant à montrer ?
4. Est-ce que mes choix couvrent plusieurs natures de problèmes ?
5. Puis-je les expliquer sans lire le code ?

### Conditions de validation du triplet

- combinaison **unique pour le même sujet** (l'ordre ne compte pas) ;
- au moins **deux familles différentes** ;
- au moins **une règle mettant en relation plusieurs objets métier** ;
- au moins **une difficulté intermédiaire ou avancée** ;
- combinaison validée par l'enseignant.

Exemple : `B1 + B5 + B8` est identique à `B8 + B1 + B5` ; si le premier étudiant l'a réservé, le second doit choisir autrement.

Une difficulté avancée n'est pas systématiquement meilleure : une règle intermédiaire bien testée vaut mieux qu'une règle spectaculaire inachevée.

## Réserver

Copiez [CHOIX_REGLES.md](../templates/CHOIX_REGLES.md) dans votre dépôt, puis ajoutez :

- triplet contractuel trié par ID ;
- trois extensions triées par priorité ;
- scène de démonstration ;
- tâches/issues ;
- dépendances de données éventuelles.

## Réaliser une règle de bout en bout

```text
besoin client
→ test/scénario attendu
→ modèle et données
→ service ou invariant de domaine
→ repository
→ contrôleur Slim / HTTP
→ HTML + JSON si concerné
→ recette + preuves
```

Les règles ne vivent pas uniquement dans les boutons et les messages JavaScript.

## Ce qui n'est PAS une règle personnalisée

Un formulaire qui exige un titre, une date de fin postérieure au début, un mot de passe haché, un CSRF ou une relation SQL valide : ces protections relèvent déjà de la qualité et des **invariants communs**.

## Une règle « intéressante » n'a pas besoin d'être compliquée

« Une réservation qui expire après 15 minutes » ou « une machine ne redémarre pas sans test signé » peut être très démonstrative, si le code gère correctement le temps, les statuts, les droits et les cas limites.
