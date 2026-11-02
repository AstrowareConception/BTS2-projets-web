# Cartes d'incident — jeudi, sur une fonctionnalité réelle

**Méthode :** choisir une carte compatible avec les fonctionnalités **effectivement présentes**. Une carte décrit un **scénario de reproduction à vérifier**, pas une affirmation que le bug existe forcément. Si le comportement est déjà correct, le faire prouver et choisir un autre cas pertinent. Aucun sabotage opaque ni injection artificielle en production.

## Backstage

**INC-B1 — Deux affectations après édition.** Un bénévolat ne peut être doublé à la création, mais qu'en est-il après modification d'horaires ? *(seulement si B1 est réalisée)*

**INC-B2 — Accès par URL directe.** Un bénévole tente d'ouvrir l'écran d'administration d'une activité par URL copiée. **À tester quel que soit le choix de règles.**

**INC-B3 — JSON d'une activité absente.** `GET /api/activities/99999` renvoie-t-il 404 ou un faux 200 ? **À tester si cette route existe.**

**INC-B4 — Incident critique résolu.** Le tableau de bord conserve-t-il un indicateur d'alerte obsolète ? *(si B4 ou B7 est réalisée)*

**INC-B5 — Activité non publiée.** La vitrine révèle-t-elle une activité en brouillon via URL directe ? **Contrôle du socle.**

## RepairLab

**INC-R1 — Édition de réservation.** Le contrôle de conflit est-il effectué autant à la modification qu'à la création ? **Contrôle du socle.**

**INC-R2 — Qualification expirée.** Une qualification ancienne passe-t-elle encore ? *(si R2 est réalisée)*

**INC-R3 — Panne critique.** Un incident bloquant interdit-il réellement une réservation depuis une route directe et pas seulement l'interface ? *(si R3 est réalisée)*

**INC-R4 — Pièces consommées.** Une tentative de consommation supérieure au stock laisse-t-elle une écriture partielle ? *(si R7 est réalisée)*

**INC-R5 — Dossier technique privé.** Un adhérent consulte-t-il une intervention réservée au technicien via URL directe ? **Contrôle du socle.**

## EscapeOps

**INC-E1 — Option expirée.** Une option de réservation déjà expirée peut-elle encore être confirmée par requête directe ? *(si E1 est réalisée)*

**INC-E2 — Groupe de taille incorrecte.** Le formulaire rejette 7 joueurs, mais l'API ou une modification ultérieure l'accepte-t-elle ? *(si E3 est réalisée)*

**INC-E3 — Jeu de rôles.** Un game master peut-il créer/supprimer une salle en modifiant l'URL ? **Contrôle du socle.**

**INC-E4 — Session indisponible.** Une réservation est-elle acceptée sur une session annulée ou passée ? **Contrôle du socle.**

**INC-E5 — Décalage de préparation.** L'édition de session contourne-t-elle le délai entre deux sessions ? *(si E4 est réalisée)*

## Éléments à exiger

- reproduction ;
- observation : méthode, URL, statut, corps, logs ;
- cause identifiée ;
- correction ;
- test ajouté ;
- résultat après correction ;
- issue et commit.

Le choix d'un incident qui n'existe pas ou n'est pas reproductible ne constitue **pas** un échec de l'étudiant : il faut adapter le scénario.
