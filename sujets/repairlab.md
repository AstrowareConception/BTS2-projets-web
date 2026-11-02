# REPAIRLAB — Le FabLab ouvre dans une heure

**Client fictif :** un FabLab associatif proposant des ateliers de fabrication, réparation et découverte.  
**Mission :** référencer les machines, réserver des créneaux, organiser la maintenance et rendre la disponibilité fiable.  
**Promesse :** « Une machine en panne ou déjà réservée ne peut pas être utilisée par erreur. »

## Votre client

Le FabLab « La Fabrique Commune » possède des imprimantes 3D, une découpeuse, des postes de soudure, des PC et des outils partagés. L'atelier d'impression du soir approche ; un adhérent réserve une machine déjà occupée pendant qu'un technicien ouvre un incident. La direction veut un outil simple, pas un ERP industriel.

Une **vitrine publique** présente le lieu et les équipements accessibles. Un **espace adhérent** permet de réserver et signaler les problèmes. Un **espace technicien** suit les interventions.

## Démonstration finale

Un adhérent réserve une imprimante depuis son compte ; un technicien signale ou traite un problème ; la disponibilité est cohérente sur la fiche HTML comme dans l'API. Vous provoquez ensuite trois scénarios de règles métier personnalisées, puis présentez une évolution et une correction.

## Socle incompressible

- Vitrine publique : présentation du FabLab et catalogue public (sans données personnelles).
- Connexion et rôles **admin / technicien / adhérent** ; droits vérifiés serveur.
- Inventaire des équipements (catégorie, statut technique, localisation, capacité de réservation unitaire).
- Réservations avec début/fin et état : `DEMANDEE`, `CONFIRMEE`, `ANNULEE`, `TERMINEE` ; parcours de création/annulation.
- Incidents, interventions simplifiées (diagnostic, action, état), recherche et filtres.
- Tableau de bord de disponibilité, au moins une ressource API JSON et une écriture métier via API.
- Traçabilité : auteur/date d'un incident, dates d'une intervention.
- Données relationnelles cohérentes et testées.

**Hors périmètre :** paiement, véritable contrôle électronique des machines, reconnaissance de badge, planning de personnel RH, IoT et commerce de pièces.

### Modèle suggéré

`User`, `Equipment`, `EquipmentCategory`, `Reservation`, `Incident`, `Intervention`. Une règle peut nécessiter `Qualification`, `StockPart`, `StockMovement` ou `CheckIn`. Ne créez ces tables que si une règle choisie le justifie.

### Invariants du socle (non sélectionnables)

Début avant fin ; équipement existant ; réservation d'un équipement unitaire sur un créneau libre (les demandes simultanées incompatibles sont refusées) ; pas d'intervention sur un incident inexistant. Ces règles simples sont **déjà obligatoires** : les règles ci-dessous apportent un comportement distinct.

## Dix règles candidates — 3 contractuelles, 3 extensions

### R1 — « La réservation prioritaire »
**Famille : planning / autorisation · Difficulté : intermédiaire.**

Certains créneaux sont réservés en priorité aux ateliers encadrés. Un adhérent ordinaire ne peut confirmer une réservation de ces créneaux, mais un responsable ou technicien autorisé peut affecter la machine à l'atelier.

**Démo :** créneau réservé à l'atelier impression ; deux profils, résultats différents.  
**Tests :** adhérent/refus ; technicien/acceptation ; créneau ordinaire/acceptation.

### R2 — « Le permis machine »
**Famille : qualification · Difficulté : intermédiaire.**

Une machine dangereuse ou complexe exige une habilitation (`LASER`, `SOUDURE`, etc.) encore valide. L'adhérent sans qualification valide ne peut réserver ; une machine ordinaire reste accessible.

**Démo :** découpeuse laser refusée, ordinateur accepté.  
**Données :** qualification reliée à utilisateur et catégorie.  
**Tests :** absence, expiration et présence.

### R3 — « Panne bloquante »
**Famille : incident / disponibilité · Difficulté : intermédiaire.**

La présence d'un incident **bloquant ouvert** interdit les nouvelles réservations de la machine. Les réservations existantes sont conservées et signalées « à vérifier » ; elles ne sont pas supprimées silencieusement.

**Démo :** machine disponible puis incident bloquant.  
**Tests :** refus nouvelle réservation ; conservation historique ; retour après résolution.

### R4 — « Pas plus de deux réservations actives »
**Famille : quota · Difficulté : accessible.**

Pour limiter la monopolisation, un adhérent ne peut avoir plus de **deux réservations futures confirmées** en parallèle, quelle que soit la machine. Les réservations annulées ou passées ne comptent pas.

**Démo :** la troisième réservation est refusée, puis une annulation libère une place.  
**Tests :** seuil ; annulation ; dates.

### R5 — « Créneau perdu après absence »
**Famille : temps / workflow · Difficulté : intermédiaire.**

Le personnel peut marquer « absent » un adhérent qui ne s'est pas présenté **15 minutes après le début** d'un créneau. Une réservation `ABSENT` libère alors le créneau pour une nouvelle demande. L'opération est manuelle : aucun cron n'est exigé.

**Démo :** marquer absent trop tôt est refusé ; après délai autorisé.  
**Tests :** avant seuil ; après seuil ; nouveau créneau disponible.

### R6 — « Un incident suit une procédure »
**Famille : workflow / habilitation · Difficulté : accessible.**

États autorisés : `OUVERT → EN_COURS → RESOLU → CLOTURE`. Seul un technicien peut commencer, résoudre ou clôturer. Un retour arrière nécessite une réouverture explicite, tracée.

**Démo :** tentative de clôture directe par un adhérent, puis transition correcte.  
**Tests :** 403 ; transition interdite ; trace.

### R7 — « Le stock de pièces ne passe jamais sous zéro »
**Famille : stock / transaction · Difficulté : avancée.**

Une intervention peut consommer des pièces. L'enregistrement de la consommation et du mouvement de stock est atomique : si le stock est insuffisant, **aucune** modification n'est conservée. Un retour est enregistré comme mouvement inverse, pas comme effacement.

**Démo :** 2 buses disponibles, demande de 3 : refus sans mouvement.  
**Tests :** succès ; échec sans stock négatif ; rollback/absence mouvement.

### R8 — « Trois pannes en trente jours »
**Famille : historique / calcul · Difficulté : intermédiaire.**

Si une machine cumule **trois incidents techniques distincts** ouverts durant les trente derniers jours, son tableau de bord affiche `CONTROLE_REQUIS`. Un technicien peut lever cet indicateur après un contrôle documenté.

**Démo :** deuxième puis troisième incident.  
**Tests :** seuil ; incident ancien ignoré ; levée tracée.

### R9 — « La vraie disponibilité expliquée »
**Famille : calcul / UX · Difficulté : intermédiaire.**

Pour une période demandée, l'application annonce un statut précis : `DISPONIBLE`, `DEJA_RESERVE`, `HORS_SERVICE` ou `MAINTENANCE`. Elle indique **la raison**, pas seulement un booléen. Le calcul utilise les états/horaires du socle, indépendamment des autres règles.

**Démo :** changer date et état technique : raisons différentes.  
**Tests :** réservation concurrente ; maintenance ; libre.

### R10 — « Validation qualité avant remise en service »
**Famille : maintenance / qualité · Difficulté : intermédiaire.**

Après une intervention, une machine signalée hors service ne peut redevenir disponible sans **diagnostic, action effectuée et résultat de test** enregistrés par un technicien.

**Démo :** tentative de remise en service sans compte rendu, puis saisie complète.  
**Tests :** dossier incomplet/refus ; dossier complet/succès.

## Données de démonstration

6 équipements dont une machine demandant une qualification, 4 adhérents, 1 technicien, 1 administrateur, 5 réservations à des créneaux variés, 2 incidents et une intervention. Préparez des données qui permettent de **provoquer puis résoudre** les situations de vos règles choisies.

## Routes API possibles

```http
GET  /api/equipment
GET  /api/equipment/{id}
GET  /api/reservations?equipmentId=2
POST /api/incidents
```

## Maquettes attendues

Catalogue public, fiche équipement, réservation, « mes créneaux », tableau de bord technicien, détail incident et message de refus métier. Utilisez des données fictives et un site crédible pour une association locale.

## Défis supplémentaires

QR code de fiche machine, export CSV de l'inventaire, panneau « atelier du jour », indicateurs de réparation. Le but n'est pas de faire une boutique de composants.

**Argument de soutenance :** gestion de disponibilité, persistance, habilitations et maintenance corrective d'une solution métier, avec règles vérifiables.
