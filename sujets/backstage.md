# Sujet 1 — Backstage

## Contexte

L’association **Backstage Horizon** organise plusieurs événements culturels : concerts, projections, conférences et ateliers. Jusqu’à présent, les informations sont dispersées entre tableurs, messageries et documents partagés.

L’organisation souhaite une application Web permettant à la fois de **présenter les événements au public** et de **piloter les opérations en interne** : activités, bénévoles, affectations, ressources matérielles et incidents.

## Utilisateurs

### Visiteur
- consulter les événements publiés ;
- consulter le programme et les informations pratiques.

### Bénévole
- consulter ses affectations ;
- signaler un incident ;
- consulter les informations nécessaires à ses missions.

### Responsable
- gérer les activités ;
- affecter les bénévoles ;
- affecter le matériel ;
- traiter les incidents ;
- suivre l’état de préparation.

### Administrateur
- gérer les utilisateurs, rôles et paramètres structurants ;
- superviser l’ensemble des événements.

## Entités métier suggérées

- User
- Role
- Event
- Activity
- Assignment
- Skill
- Equipment
- EquipmentAllocation
- Incident

Vous pouvez adapter ce modèle si vous justifiez vos choix.

## Fonctionnalités du socle

- partie publique des événements ;
- authentification ;
- gestion des rôles ;
- CRUD des événements et activités ;
- gestion des bénévoles ;
- gestion du matériel ;
- affectations ;
- incidents ;
- tableau de bord ;
- recherche / filtres ;
- API REST.

# Les 10 règles métier candidates

## B1 — Conflit d’affectation bénévole
**Famille : temporalité / intégrité — multi-entités**

Un bénévole ne peut pas être affecté à deux activités dont les créneaux se chevauchent.

**Acceptation :**
- l’application détecte le chevauchement avant enregistrement ;
- elle explique clairement le conflit ;
- elle autorise deux activités consécutives sans chevauchement.

## B2 — Compétence requise
**Famille : habilitation — multi-entités**

Une activité peut exiger une ou plusieurs compétences. Un bénévole ne peut être affecté que s’il possède toutes les compétences marquées obligatoires.

**Acceptation :**
- compétences requises configurables par activité ;
- contrôle côté serveur ;
- message indiquant la compétence manquante.

## B3 — Conflit de matériel
**Famille : ressource / temporalité — multi-entités**

Un même équipement ne peut être affecté à deux activités qui se chevauchent, sauf si sa quantité disponible est supérieure à 1.

**Acceptation :**
- prise en compte des quantités ;
- refus si le stock disponible sur le créneau est dépassé.

## B4 — Équipement critique indisponible
**Famille : workflow — multi-entités**

Une activité possédant un équipement marqué critique ne peut passer à l’état `READY` si cet équipement est indisponible ou en incident bloquant.

**Acceptation :**
- l’état dépend de la disponibilité réelle ;
- la remise en service permet à nouveau la validation.

## B5 — Seuil minimal d’équipe
**Famille : calcul / workflow — multi-entités**

Chaque activité définit un nombre minimal de bénévoles. L’activité n’est considérée « prête » que si le seuil est atteint.

**Acceptation :**
- indicateur visible ;
- mise à jour après ajout/retrait d’une affectation ;
- impossible de marquer prête sous le seuil.

## B6 — Responsable obligatoire
**Famille : habilitation / intégrité — multi-entités**

Toute activité publiée doit posséder exactement un responsable principal actif.

**Acceptation :**
- publication refusée sans responsable ;
- impossibilité d’avoir deux responsables principaux ;
- changement de responsable tracé.

## B7 — Escalade d’incident
**Famille : workflow / automatisation — multi-entités**

Un incident de gravité critique lié à une activité fait automatiquement passer l’activité en état `AT_RISK` et apparaît en priorité sur le tableau de bord.

**Acceptation :**
- changement d’état automatique ;
- priorité visible ;
- résolution de l’incident ne doit pas effacer l’historique.

## B8 — Sortie et retour du matériel
**Famille : workflow / traçabilité — multi-entités**

Un équipement affecté peut être marqué `CHECKED_OUT` puis `RETURNED`. Un retour après l’heure prévue est signalé comme retard.

**Acceptation :**
- horodatage ;
- statut cohérent ;
- historique consultable.

## B9 — Publication contrôlée d’un événement
**Famille : qualité / workflow — multi-entités**

Un événement ne peut être publié que s’il possède au moins une activité publiée, des dates cohérentes et les informations publiques obligatoires.

**Acceptation :**
- liste des conditions manquantes ;
- publication impossible tant qu’elles ne sont pas remplies.

## B10 — Taux de préparation
**Famille : calcul / agrégation — multi-entités**

Le tableau de bord calcule un taux de préparation de l’événement à partir des activités prêtes, des incidents bloquants et des besoins matériels satisfaits.

**Acceptation :**
- formule documentée ;
- calcul reproductible ;
- détail des éléments qui pénalisent le score.

## Exemples d’API

```http
GET /api/events
GET /api/events/{id}/activities
GET /api/activities/{id}/readiness
POST /api/incidents
```

## Pistes de maquette

- page publique événement ;
- programme ;
- tableau de bord responsable ;
- fiche activité ;
- planification des bénévoles ;
- inventaire matériel ;
- centre d’incidents.

## Bonus spécifiques

- vue calendrier ;
- export du planning ;
- QR code pour sortie/retour matériel ;
- statistiques de charge des bénévoles ;
- historique d’audit d’une activité.
