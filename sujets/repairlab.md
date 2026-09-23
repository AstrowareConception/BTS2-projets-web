# Sujet 2 — RepairLab

## Contexte

**RepairLab** est un Repair Café / FabLab associatif. Il met à disposition des adhérents du matériel : imprimantes 3D, stations de soudure, ordinateurs, outils, machines de découpe et équipements de diagnostic.

La gestion actuelle ne permet pas de savoir rapidement ce qui est disponible, qui utilise quoi, quelles machines nécessitent une habilitation, ni quels incidents sont en cours.

L’application doit proposer une **vitrine publique** et un **système interne de réservation, suivi du matériel et maintenance**.

## Utilisateurs

### Visiteur
- consulter le lieu, les ateliers et une partie du catalogue.

### Adhérent
- consulter le matériel ;
- réserver une ressource autorisée ;
- déclarer un incident ;
- consulter ses réservations.

### Technicien
- traiter les incidents ;
- créer des interventions ;
- gérer les états techniques.

### Administrateur
- gérer utilisateurs, rôles, équipements, catégories et habilitations.

## Entités suggérées

- User
- Role
- Equipment
- EquipmentType
- Qualification
- UserQualification
- Reservation
- Incident
- Intervention
- Part / StockMovement

## Fonctionnalités du socle

- catalogue public ;
- authentification ;
- rôles ;
- inventaire ;
- réservations ;
- incidents ;
- interventions ;
- tableau de bord ;
- recherche / filtres ;
- API REST.

# Les 10 règles métier candidates

## R1 — Réservation sans chevauchement
**Famille : temporalité / intégrité — multi-entités**

Un équipement ne peut pas être réservé par deux adhérents sur des créneaux qui se chevauchent.

**Acceptation :**
- détection côté serveur ;
- bornes temporelles correctement gérées ;
- message expliquant le conflit.

## R2 — Habilitation obligatoire
**Famille : habilitation — multi-entités**

Certains types d’équipements nécessitent une qualification. Une réservation est refusée si l’adhérent ne possède pas une qualification valide.

**Acceptation :**
- qualification rattachée au type d’équipement ;
- date de validité possible ;
- contrôle au moment de la réservation.

## R3 — Incident bloquant
**Famille : workflow — multi-entités**

Un incident critique ouvert rend l’équipement indisponible et bloque automatiquement les nouvelles réservations.

**Acceptation :**
- indisponibilité dérivée de l’incident ;
- message visible ;
- retour à un état réservable après résolution selon les règles définies.

## R4 — Quota de réservations
**Famille : calcul / quota — multi-entités**

Un adhérent ne peut avoir plus de N réservations actives simultanément. La valeur N est paramétrable.

**Acceptation :**
- seules les réservations pertinentes comptent ;
- message indiquant le quota.

## R5 — Retard et suspension temporaire
**Famille : workflow / temporalité — multi-entités**

Après un nombre défini de retards de restitution sur une période donnée, l’adhérent est temporairement empêché de réserver.

**Acceptation :**
- période et seuil documentés ;
- historique conservé ;
- date de fin de suspension connue.

## R6 — Cycle de vie d’un incident
**Famille : workflow / habilitation**

Un incident suit le cycle `OPEN -> IN_PROGRESS -> RESOLVED -> CLOSED`. Certains changements d’état sont réservés aux techniciens.

**Acceptation :**
- transitions invalides refusées ;
- auteur et date des transitions conservés.

## R7 — Consommation de pièces
**Famille : stock / intégrité — multi-entités**

Une intervention peut consommer des pièces détachées. La clôture est refusée si la consommation rend le stock négatif.

**Acceptation :**
- mouvements de stock tracés ;
- quantité disponible contrôlée ;
- consommation liée à l’intervention.

## R8 — Pannes répétées
**Famille : agrégation / automatisation — multi-entités**

Si un équipement cumule au moins X incidents techniques sur Y jours, il passe en état `REVIEW_REQUIRED` et doit être contrôlé avant nouvelle réservation.

**Acceptation :**
- X et Y documentés ;
- calcul sur l’historique ;
- remise en service explicite par un technicien.

## R9 — Disponibilité calculée
**Famille : calcul / workflow — multi-entités**

L’état « disponible à la réservation » dépend de l’état technique, des incidents bloquants, des réservations et des éventuelles périodes de maintenance.

**Acceptation :**
- une fonction/service centralise le calcul ;
- l’interface explique pourquoi un matériel est indisponible.

## R10 — Clôture d’intervention avec validation
**Famille : qualité / workflow — multi-entités**

Une intervention ne peut être clôturée qu’après saisie d’un diagnostic, d’une action réalisée et d’un résultat de test final.

**Acceptation :**
- champs obligatoires côté serveur ;
- résultat du test historisé ;
- équipement remis en service seulement si le test le permet.

## Exemples d’API

```http
GET /api/equipment
GET /api/equipment/{id}/availability
POST /api/reservations
POST /api/incidents
```

## Pistes de maquette

- catalogue ;
- fiche équipement ;
- réservation ;
- espace adhérent ;
- tableau de bord technicien ;
- fiche incident/intervention ;
- état des stocks.

## Bonus spécifiques

- QR code par équipement ;
- calendrier de réservation ;
- import d’inventaire CSV ;
- indicateurs MTTR simplifiés ;
- alertes de stock bas ;
- historique complet d’un équipement.
