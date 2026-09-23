# Sujet 3 — EscapeOps

## Contexte

**EscapeOps** exploite plusieurs salles d’escape game. Chaque salle possède une capacité, un ensemble d’équipements et des contraintes de préparation. L’entreprise organise des sessions, prend des réservations et doit réagir rapidement lorsqu’un équipement tombe en panne ou lorsqu’une salle n’est pas prête.

L’application doit proposer une **présentation publique des salles** et un **outil interne de gestion des sessions, réservations, équipements et incidents**.

## Utilisateurs

### Visiteur / client
- consulter les salles ;
- consulter les créneaux disponibles ;
- effectuer ou préparer une réservation selon le périmètre retenu.

### Game master
- consulter ses sessions ;
- réaliser la préparation ;
- signaler un incident ;
- mettre à jour le déroulement d’une session.

### Responsable
- gérer salles, sessions, équipements et incidents ;
- suivre les disponibilités.

### Administrateur
- gérer utilisateurs, rôles et paramètres.

## Entités suggérées

- User
- Role
- Room
- Session
- Booking
- GameMasterAssignment
- Equipment
- RoomEquipment
- Incident
- ReadinessCheck

## Fonctionnalités du socle

- vitrine publique ;
- authentification ;
- rôles ;
- salles ;
- créneaux/sessions ;
- réservations ;
- équipements ;
- incidents ;
- tableau de bord ;
- API REST.

# Les 10 règles métier candidates

## E1 — Pas de double réservation
**Famille : temporalité / intégrité — multi-entités**

Une session ne peut recevoir qu’une réservation confirmée. Une réservation concurrente sur la même session doit être refusée.

**Acceptation :**
- vérification côté serveur ;
- statut des réservations pris en compte ;
- conflit signalé clairement.

## E2 — Équipement critique et fermeture de salle
**Famille : workflow — multi-entités**

Si un équipement critique d’une salle possède un incident bloquant, la salle devient indisponible et aucune nouvelle session ne peut être ouverte à la réservation.

**Acceptation :**
- conséquence automatique ;
- raison d’indisponibilité visible ;
- retour à la normale contrôlé.

## E3 — Capacité du groupe
**Famille : calcul / intégrité — multi-entités**

Le nombre de joueurs doit respecter le minimum et le maximum définis pour la salle.

**Acceptation :**
- contrôle à la réservation ;
- limites affichées ;
- modification ultérieure également contrôlée.

## E4 — Temps de remise en état
**Famille : temporalité — multi-entités**

Deux sessions d’une même salle doivent respecter un délai minimal de remise en état configurable.

**Acceptation :**
- création/modification de session contrôlée ;
- calcul exact entre heure de fin et prochaine heure de début.

## E5 — Affectation du game master
**Famille : ressource / temporalité — multi-entités**

Un game master ne peut pas superviser deux sessions simultanées et doit être affecté avant qu’une session passe à l’état `READY`.

**Acceptation :**
- détection de conflit ;
- session non prête sans game master.

## E6 — Incident en cours de session
**Famille : workflow / automatisation — multi-entités**

Un incident critique déclaré pendant une session place celle-ci en état `INTERRUPTED` et signale les sessions suivantes potentiellement impactées.

**Acceptation :**
- changement d’état ;
- liste des sessions impactées ;
- historique conservé.

## E7 — Politique d’annulation
**Famille : temporalité / calcul — multi-entités**

Une réservation annulée suffisamment tôt est marquée `CANCELLED_FREE`; au-delà d’un délai paramétré, elle devient `CANCELLED_LATE`.

**Acceptation :**
- règle fondée sur date/heure ;
- seuil documenté ;
- statut calculé de façon cohérente.

## E8 — No-show
**Famille : workflow / temporalité — multi-entités**

Après un délai défini suivant le début de session, une réservation confirmée non enregistrée à l’accueil peut passer à l’état `NO_SHOW`.

**Acceptation :**
- transition impossible avant le délai ;
- action tracée.

## E9 — Maintenance préventive
**Famille : agrégation / automatisation — multi-entités**

Après N sessions terminées depuis la dernière maintenance, la salle ou un équipement défini passe en état `MAINTENANCE_DUE`.

**Acceptation :**
- compteur fondé sur l’historique ;
- remise à zéro après maintenance validée ;
- avertissement visible.

## E10 — Checklist de préparation
**Famille : qualité / workflow — multi-entités**

Une session ne peut passer à `READY` que si les points obligatoires de sa checklist sont validés, aucun incident bloquant n’est ouvert et le game master est affecté.

**Acceptation :**
- checklist configurable ou structurée ;
- refus détaillant les éléments manquants ;
- validation horodatée.

## Exemples d’API

```http
GET /api/rooms
GET /api/rooms/{id}/availability
GET /api/sessions
POST /api/incidents
```

## Pistes de maquette

- vitrine des salles ;
- calendrier des sessions ;
- réservation ;
- tableau de bord d’exploitation ;
- fiche session ;
- checklist ;
- centre d’incidents.

## Bonus spécifiques

- planning calendrier ;
- tableau d’occupation des salles ;
- indicateurs de taux de remplissage ;
- QR code de check-in ;
- journal technique des équipements ;
- écran « mode exploitation » optimisé tablette.
