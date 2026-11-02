# ESCAPEOPS — Un escape game, trente minutes avant l'ouverture

**Client fictif :** « Les Archives Obscures », petite société exploitant trois salles d'escape game.  
**Mission :** vendre une expérience fluide aux visiteurs **sans développer de paiement**, et donner à l'équipe un véritable poste de conduite des sessions.  
**Promesse :** « Personne ne réserve une salle indisponible ; l'équipe sait pourquoi une session peut ou non démarrer. »

## La situation

Un groupe de six joueurs arrive à 18 h. La salle « Le Cabinet des Ombres » a besoin de vingt minutes de remise en état, un mécanisme de porte a un défaut, et le game master prévu doit également animer une autre salle. Le responsable n'a pas le temps de recouper les messages du personnel.

Vous créez un outil professionnel **de planning et d'exploitation**. Son habillage peut être immersif et élégant ; ses règles doivent rester de vraies décisions d'exploitation.

## Concept de réservation — à ne pas confondre

**Une session représente un créneau privatisé pour un groupe entier**, pas un siège individuel. Une session accepte donc **une réservation confirmée au maximum**, contenant le nombre de joueurs du groupe. Cela rend compatibles la règle E1 et la capacité E3.

**Hors périmètre :** paiement, billetterie multi-groupes par session, envoi de SMS, serrures connectées, logiciel de création des énigmes, moteur de jeu 3D.

## Socle obligatoire

- Vitrine publique présentant les salles, leur thème, durée, capacité et créneaux publiés.
- Connexion/déconnexion et rôles **administrateur / responsable / game master** (un client public peut réserver sans compte avec contact fictif, si sa gestion est justifiée).
- Salles, sessions horaires, réservations de groupes, fiches game master, équipements liés à une salle, incidents et recherche.
- Session avec états simples `PREVUE`, `PRETE`, `EN_COURS`, `TERMINEE`, `ANNULEE`. Une réservation porte `CONFIRMEE` ou `ANNULEE`.
- Tableau de bord de l'exploitation : prochaines sessions, incidents ouverts, disponibilité.
- Au moins une relation N–N utile (salle ↔ équipement via table d'affectation, ou session ↔ intervenant).
- API JSON permettant liste/détail et création d'un incident ou réservation.

**Invariants non sélectionnables :** fin après début ; impossible de réserver une session supprimée, passée ou déjà confirmée ; l'utilisateur ne peut modifier une session sans droit. Ces garde-fous forment le socle.

## Les 10 règles métier

### E1 — « Première réservation, première servie »
**Famille : réservation / intégrité · Difficulté : intermédiaire.**

Une réservation `CONFIRMEE` bloque le créneau privatisé ; une demande concurrente reçoit un refus explicite. La réservation annulée libère le créneau. Testez la cohérence en base, pas seulement l'affichage d'un bouton.

**Démo :** deux groupes veulent la même session ; seul le premier obtient confirmation.  
**Tests :** doublon refusé ; annulation libératrice ; base cohérente.

### E2 — « Le mécanisme critique est hors service »
**Famille : incident / disponibilité · Difficulté : intermédiaire.**

Un incident bloquant sur un **équipement critique** empêche les nouvelles réservations de sessions de la salle. Les réservations déjà confirmées sont signalées « à recontacter », pas effacées.

**Démo :** énigme de la porte verrouillée en panne ; nouvelles réservations refusées.  
**Tests :** équipement non critique sans blocage ; critique bloquant ; résolution.

### E3 — « Groupe de deux à six aventuriers »
**Famille : capacité / calcul · Difficulté : accessible.**

Chaque salle définit une taille minimale et maximale du groupe. La réservation est refusée hors de cette fourchette, y compris à la modification.

**Démo :** groupe de 7 pour une salle limitée à 6.  
**Tests :** bornes inclusives ; dépassement ; édition.

### E4 — « Vingt minutes entre deux missions »
**Famille : planning / temporalité · Difficulté : intermédiaire.**

Deux sessions **de la même salle** doivent respecter le temps de remise en état paramétré sur celle-ci. Ce contrôle vaut pour création et modification de session.

**Démo :** nouvelle session 10 minutes après la précédente : refus ; 20 minutes : accord.  
**Tests :** limite exacte ; chevauchement ; autre salle acceptée.

### E5 — « Un game master ne peut pas se dédoubler »
**Famille : personnel / temps · Difficulté : intermédiaire.**

Lorsqu'un game master est affecté à une session, aucune autre session sur un créneau chevauchant ne peut lui être affectée. Une session peut rester planifiée sans affectation mais ne peut démarrer sans game master.

**Démo :** même personne affectée aux deux salles à 18 h.  
**Tests :** conflits ; créneaux jointifs ; refus au démarrage sans affectation.

### E6 — « Partie interrompue »
**Famille : incident / workflow · Difficulté : intermédiaire.**

Un incident critique créé pendant une session `EN_COURS` passe celle-ci à `INTERROMPUE`. La reprise nécessite une action explicite du responsable et laisse une trace. Pas de déclencheur matériel réel.

**Démo :** le game master déclare un problème de sécurité ; la session se bloque.  
**Tests :** interruption ; reprise autorisée ; historique.

### E7 — « Annuler au bon moment »
**Famille : temps / politique commerciale · Difficulté : accessible.**

Une annulation est classée `SANS_FRAIS` si elle intervient **au moins 24 heures avant** le début, et `TARDIVE` sinon. **Aucun paiement n'est traité** : le statut informe le responsable et le client.

**Démo :** annulation à 26 h puis à 2 h.  
**Tests :** frontière 24 h ; avant/après ; statut conservé.

### E8 — « Les joueurs ne sont pas venus »
**Famille : accueil / temps · Difficulté : intermédiaire.**

Le responsable ou game master peut marquer une réservation `ABSENT` seulement **15 minutes après le début de session** si aucun check-in n'a été validé. L'opération est manuelle et tracée : aucun traitement planifié n'est exigé.

**Démo :** « absent » impossible à H+5, possible à H+15.  
**Tests :** délai ; joueur enregistré ; habilitation.

### E9 — « Maintenance préventive après dix parties »
**Famille : historique / seuil · Difficulté : intermédiaire.**

Chaque salle affiche `CONTROLE_A_PREVOIR` après **10 sessions terminées** depuis le dernier contrôle documenté. Le responsable peut enregistrer le contrôle, ce qui redémarre le compteur.

**Démo :** dixième session terminée : badge de maintenance.  
**Tests :** 9/10 ; contrôle remettant compteur à zéro ; sessions annulées ignorées.

### E10 — « Checklist avant ouverture »
**Famille : qualité / workflow · Difficulté : intermédiaire.**

Avant le passage d'une session à `PRETE`, un game master doit valider les trois points standards : **salle rangée, matériel testé, consignes sécurité vérifiées**. Le nom, la date et les valeurs restent enregistrés. Cette règle n'exige pas E5.

**Démo :** 2/3 points = « non prête » ; 3/3 = prête.  
**Tests :** incomplet/refus ; complet/succès ; contrôle serveur.

## Scénario de recette à raconter

Un responsable crée les sessions du jour, le public réserve un créneau, un game master prépare la salle, un incident imprévu modifie l'exploitation. La logique diffère selon les trois règles contractuelles choisies ; toute la chaîne doit être démontrable.

## Données minimales

3 salles, 2 game masters, 1 responsable, 1 administrateur, 8 sessions dont 2 dans la même salle, 4 réservations de groupes fictifs, 5 équipements (dont un critique), 2 incidents. Préparez les états nécessaires à vos règles.

## Contrat API possible

```http
GET  /api/rooms
GET  /api/rooms/{id}
GET  /api/sessions?roomId=1
POST /api/incidents
```

## Maquettes

Vitrine immersive, fiche salle, créneaux, réservation groupe, cockpit du responsable « prochaines sessions », fiche session, saisie incident, message de conflit. Le visuel peut être captivant, mais **les droits, heures et états doivent être fiables**.

## Bonus

Planning calendrier, écran « régie » sur tablette, QR code de check-in, taux d'occupation, historique de maintenance. Pas d'intégration matérielle dangereuse.

**Argument de soutenance :** conception d'une solution applicative de réservation et d'exploitation, règles temporelles, sécurité, API, tests et maintenance.
