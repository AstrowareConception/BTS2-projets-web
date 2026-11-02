# 09 — Deux événements professionnels imprévus

Le projet reçoit une **nouvelle demande client mercredi** puis un **incident jeudi**. Vous devez démontrer votre capacité à modifier puis maintenir une solution existante.

## Mercredi — Un ticket d'évolution calibré

L'enseignant choisit de préférence un besoin inspiré d'une des quatre règles que vous n'avez pas sélectionnées, mais **en réduit le périmètre à une tranche verticale réaliste**. Il ne s'agit pas d'ajouter obligatoirement une quatrième règle avancée complète.

**Exemple :** le client demande de rendre configurable un délai de préparation déjà fixe, et d'expliquer un refus dans le tableau de bord.

### Avant de coder

Créez une issue :
1. nouveau besoin reformulé ;
2. composants concernés (modèle, repository, vues, API) ;
3. données/migration éventuellement nécessaires ;
4. cas de recette ;
5. estimation ;
6. risques de régression.

### Après

Commit identifiable, test associé, documentation et maquette mises à jour si impact réel.

## Jeudi — Un incident sur votre produit réel

L'enseignant choisit un dysfonctionnement sur **une fonctionnalité que vous avez effectivement réalisée**. Il peut fournir un scénario de reproduction ou un jeu de données particulier. Il ne vous impose pas une correction sur une règle optionnelle absente.

Vous devez :
1. reproduire précisément ;
2. observer méthode/statut/corps ou log ;
3. formuler une hypothèse ;
4. identifier la cause ;
5. corriger ;
6. ajouter un test de non-régression ;
7. rédiger [le rapport d'incident](../templates/RAPPORT_INCIDENT.md).

**Une panne SQL ne devient pas artificiellement un 404 ; un conflit métier ne doit pas produire une stack trace 500.**

La qualité de votre diagnostic compte autant que la correction.
