# Cartes incident — Jeudi

Choisir un incident cohérent avec l’état réel de l’application. L’objectif est le diagnostic, pas le piège artificiel.

## Backstage

### INC-B1 — Double affectation
Un bénévole peut être affecté à deux activités qui se chevauchent après modification d’une affectation existante.

### INC-B2 — Autorisation
Un bénévole connecté peut ouvrir directement l’URL d’édition d’une activité.

### INC-B3 — Matériel
Le stock disponible est correctement contrôlé à la création d’une affectation mais pas lors de sa modification.

### INC-B4 — Incident critique
La résolution d’un incident critique remet automatiquement l’activité en `READY` alors que son équipe minimale n’est pas complète.

### INC-B5 — Publication
Un événement sans activité publiée reste accessible via son URL publique.

### INC-B6 — API
L’API renvoie `200` avec un objet vide pour un identifiant inexistant au lieu d’une erreur explicite.

## RepairLab

### INC-R1 — Conflit après modification
La création empêche deux réservations concurrentes, mais modifier une réservation permet un chevauchement.

### INC-R2 — Habilitation expirée
Une qualification expirée est encore acceptée.

### INC-R3 — Incident résolu
Un équipement reste bloqué après la résolution valide du dernier incident critique.

### INC-R4 — Stock
Deux interventions successives permettent de rendre le stock négatif dans un cas limite.

### INC-R5 — Autorisation
Un adhérent peut consulter le détail d’une intervention technique via une URL directe.

### INC-R6 — API
Une réservation invalide provoque une erreur serveur au lieu d’un `4xx` documenté.

## EscapeOps

### INC-E1 — Chevauchement de sessions
La création respecte le temps de remise en état, mais pas l’édition.

### INC-E2 — Salle critique
Une session déjà ouverte à la réservation reste réservable après incident critique.

### INC-E3 — Capacité
La capacité est contrôlée à la création mais une modification ultérieure accepte trop de joueurs.

### INC-E4 — Game master
Un game master peut être affecté à deux sessions simultanées depuis l’écran d’édition.

### INC-E5 — Checklist
Une session passe à `READY` si les cases obligatoires existent mais ne sont pas toutes validées.

### INC-E6 — API
Une salle indisponible est annoncée disponible par un endpoint d’API à cause d’une logique dupliquée.
