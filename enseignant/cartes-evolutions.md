# Cartes d'évolution — à distribuer mercredi

**Contrainte d'attribution :** choisir une évolution qui s'appuie sur une fonctionnalité **déjà fonctionnelle**, avec une adaptation réalisable sur une tranche verticale. De préférence, s'inspirer de l'une des quatre règles non retenues, sans imposer la règle avancée entière.

L'étudiant fournit avant de coder : issue, analyse d'impact, test positif et négatif, estimation. Pas de changement hors contrôle des règles existantes.

## Backstage

**EV-B-A — La coordinatrice veut connaître les retards.** Une affectation de bénévole peut recevoir un indicateur `ABSENT` après son horaire de début. La liste des activités du jour doit le signaler. Aucune notification externe.

**EV-B-B — Priorité sur le conducteur.** Un incident existant peut être marqué « à traiter en premier » par le responsable ; ce marqueur est visible dans le tableau de bord et dans l'API concernée.

**EV-B-C — Un changement de lieu.** Une activité publiée peut changer de salle, avec motif et historique minimal. L'affichage public doit refléter le lieu actuel.

**EV-B-D — Rendre la préparation lisible.** Ajouter un filtre « activités à risque » reposant sur les incidents existants ; pas de nouvel algorithme de score complexe.

## RepairLab

**EV-R-A — Le technicien veut une note de restitution.** Sur une réservation clôturée, le personnel peut enregistrer une observation et la date de fin. Interdire la modification par l'adhérent.

**EV-R-B — Maintenance annoncée.** Un équipement possède une date de début et fin d'indisponibilité de maintenance ; la recherche par disponibilité indique pourquoi il est bloqué.

**EV-R-C — Raison du refus.** En cas de réservation impossible, la réponse indique explicitement `DEJA_RESERVE`, `HORS_SERVICE` ou `NON_AUTORISE` selon le cas déjà géré.

**EV-R-D — Contrôle après incident.** Lorsqu'un incident est résolu, le technicien saisit un résultat de vérification simple ; pas de gestion avancée des pièces.

## EscapeOps

**EV-E-A — Temps de remise en état variable.** La durée de préparation n'est plus identique pour toutes les salles ; elle devient un paramètre par salle, contrôlé lors de la création ou modification de session.

**EV-E-B — Le client veut connaître son annulation.** Toute réservation annulée reçoit la date et le motif d'annulation, visibles au responsable.

**EV-E-C — Vérifier l'heure de départ.** Un game master peut saisir l'heure réelle de démarrage ; le tableau de bord signale un retard sans envoyer de SMS.

**EV-E-D — Un créneau non réservable.** Un responsable peut rendre une session temporairement indisponible avec un motif ; la vitrine publique et la réponse API doivent respecter la décision.

## Arbitrage du niveau

- **Rouge :** adaptation simple d'une validation, d'un champ ou d'un état déjà existant.
- **Orange :** nouvelle information et modification de deux couches.
- **Vert :** extension de modèle + API + test de non-régression.

Le mercredi soir : analyse. Le jeudi matin : réalisation puis tests. **Ne pas attribuer le ticket le plus sophistiqué à un étudiant qui a déjà un socle en panne.**
