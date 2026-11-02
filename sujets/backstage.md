# BACKSTAGE — Le festival tient-il debout ?

**Client fictif :** l'association Backstage Horizon, qui organise un festival culturel de quartier sur deux jours.  
**Mission :** une application Web de coordination, vitrine publique et poste de pilotage pour l'équipe.  
**Promesse de démonstration :** « En moins d'une minute, je sais qui intervient, où, avec quel matériel et ce qui empêche l'ouverture. »

## La situation client

Le festival « Les Nuits du Phare » approche. Deux scènes, une salle de conférence et un atelier accueillent concerts, quiz, débats et performances. Les bénévoles changent de créneaux, le vidéoprojecteur est prêté à plusieurs équipes, et les responsables découvrent trop tard certaines incompatibilités. Les fichiers partagés et messages instantanés n'offrent aucune vision fiable.

À la demande de la coordinatrice, vous concevez **Backstage**, un outil crédible pour six à vingt bénévoles et une programmation d'une quinzaine d'activités. Il ne s'agit ni d'une billetterie, ni d'un réseau social, ni d'un logiciel de gestion d'un festival international.

### Votre démonstration de vendredi

1. Le public consulte un programme effectivement publié.
2. Un responsable consulte le tableau de bord des activités et affectations.
3. Un bénévole se connecte et visualise ses missions.
4. Vous déclenchez une de vos **trois règles contractuelles** et montrez un refus, une conséquence ou un calcul.
5. Le même élément est consultable depuis la vue HTML et l'API JSON.
6. Vous expliquez une évolution et un incident corrigé.

## Périmètre incompressible (commun à tous les étudiants Backstage)

- Une **vitrine publique** avec présentation du festival, programme et fiche d'activité publiée.
- Connexion, déconnexion et rôles **administrateur / responsable / bénévole**, avec droits serveur réellement différents.
- Gestion simplifiée : événements, activités (titre, lieu, début, fin, état), bénévoles, affectations, équipements (quantité), demandes de matériel et signalements d'incidents.
- Fiches, listes, recherche/filtre et tableau de bord « aujourd'hui / à traiter ».
- Au moins un parcours complet **création → mise à jour → consultation** ; conservation des relations entre données.
- Une API JSON consommable indépendamment de l'HTML, avec au minimum liste, détail et une création métier.
- Historique minimal : date et auteur d'un signalement ou changement significatif.

**À ne pas développer :** paiement, vente de billets, SMS, géolocalisation temps réel, météo externe automatique, système d'emails complexe. Ces intégrations ne sont pas nécessaires à la RP.

### Modèle de départ (à adapter et justifier)

`User`, `Event`, `Activity`, `Assignment`, `Equipment`, `EquipmentAllocation`, `Incident`. Les rôles peuvent être portés par une colonne ou une table selon la conception ; une table supplémentaire est possible pour une règle. Une association activité–bénévole via `Assignment` constitue une vraie relation N–N.

### Règles partagées, même sans les sélectionner

Une activité a une heure de fin strictement postérieure au début ; une affectation vise une activité et un bénévole existants ; une quantité matérielle ne peut être négative ; une activité non publiée n'apparaît pas sur la vitrine. Ces **invariants de base ne comptent pas** parmi les règles personnalisées.

## Choisissez 3 règles contractuelles + 3 extensions

Chaque règle ci-dessous est **indépendante des autres règles optionnelles** : elle s'appuie sur le socle ci-dessus. La « difficulté » estime le travail supplémentaire, pas une note. La règle est à mettre en œuvre côté serveur, y compris pour une éventuelle route API.

### B1 — « Deux scènes, un seul bénévole »
**Famille : planning · Difficulté : intermédiaire.**

Un bénévole ne peut être affecté à deux activités se chevauchant. Deux créneaux exactement consécutifs restent acceptables. Une modification d'horaires doit réexécuter le contrôle.

**Scène de démo :** affectez Léa aux coulisses de 17 h à 18 h, puis à la billetterie de 17 h 30 à 18 h 30 : refus explicite. Essayez 18 h–19 h : accepté.  
**Tests :** chevauchement refusé ; limite jointive acceptée ; édition contrôlée.

### B2 — « Le régisseur doit être habilité »
**Famille : habilitation métier · Difficulté : intermédiaire.**

Certaines activités portent une compétence requise (`SON`, `LUMIÈRE`, `PREMIERS_SECOURS`). L'affectation à cette mission est refusée si le bénévole ne possède pas la qualification ; les activités sans qualification restent ouvertes à tous.

**Scène :** affecter une personne sans compétence SON à la régie, puis à l'accueil.  
**Données ajoutées possibles :** compétences de bénévoles et compétence requise.  
**Tests :** compétence absente/refus ; compétence présente/acceptation.

### B3 — « Le micro voyageur »
**Famille : matériel / capacité · Difficulté : avancée.**

Un équipement possède une quantité disponible. Les demandes validées d'activités qui se chevauchent ne doivent jamais dépasser cette quantité ; les demandes annulées ne la consomment plus.

**Scène :** un seul micro HF, déjà affecté à la scène A ; une seconde affectation simultanée est refusée.  
**Tests :** stock épuisé ; stock restant ; annulation libérant la capacité.

### B4 — « Incident bloquant avant ouverture »
**Famille : incidents / statut · Difficulté : intermédiaire.**

Un incident de gravité **bloquante** sur une activité empêche le responsable de la marquer « prête ». La résolution enregistrée par un responsable permet de retenter l'action, sans effacer l'incident.

**Scène :** un câble d'alimentation déclaré défectueux interdit « prêt ».  
**Tests :** incident ouvert/refus ; incident résolu/acceptation.

### B5 — « Une équipe complète, sinon rien »
**Famille : seuil / calcul · Difficulté : accessible.**

Une activité précise son effectif minimum. Le tableau de bord affiche « X / minimum », et l'action « déclarer prête » est impossible si trop peu de bénévoles sont affectés.

**Scène :** atelier demandant trois bénévoles ; seulement deux affectés.  
**Tests :** sous-seuil/refus ; seuil atteint/acceptation.

### B6 — « Pas de publication sans responsable »
**Famille : publication / droits · Difficulté : accessible.**

Une activité ne peut être publiée si aucun responsable actif ne lui est attribué ; un bénévole ne peut pas publier directement. L'ancienne publication reste traçable.

**Scène :** activité sans responsable, puis avec responsable.  
**Tests :** absence responsable/refus ; rôle insuffisant/403 ; publication valide.

### B7 — « Alerte rouge au poste de commandement »
**Famille : signalement / priorisation · Difficulté : intermédiaire.**

Lorsqu'un incident est enregistré avec la sévérité `CRITIQUE`, il passe dans la liste prioritaire du tableau de bord. Un responsable doit pouvoir l'accuser réception ; cette opération est tracée.

**Scène :** le « projecteur en panne » passe avant les incidents mineurs.  
**Tests :** ordre/priorité ; accusé réception horodaté ; accès protégé.

### B8 — « Retour de matériel en retard »
**Famille : traçabilité / temps · Difficulté : intermédiaire.**

Une allocation de matériel peut être sortie puis restituée. Le système mémorise heure prévue et heure réelle ; un retour tardif est signalé sans modifier rétroactivement les dates.

**Scène :** une enceinte rendue après son heure prévue apparaît « en retard ».  
**Tests :** retour à l'heure ; retour en retard ; double retour interdit.

### B9 — « Programme prêt à être publié »
**Famille : publication / cohérence · Difficulté : intermédiaire.**

Un événement peut être publié seulement si son titre, ses dates et son lieu sont renseignés **et** s'il contient au moins une activité publiée. Sinon, la liste précise des informations manquantes est affichée.

**Scène :** festival sans activité publiée puis événement complété.  
**Tests :** échec avec raisons ; succès après correction.

### B10 — « Le feu tricolore de préparation »
**Famille : tableau de bord / agrégats · Difficulté : intermédiaire.**

Calculez un score clair **à partir du socle**, indépendamment de B4/B5/B9 : part des activités avec un responsable et au moins un bénévole affecté, moins une pénalité visible pour chaque incident critique ouvert. Fixez et expliquez la formule ; le score reste entre 0 et 100.

**Scène :** le score augmente après affectation et baisse à la déclaration d'un incident.  
**Tests :** événement vide ; événement préparé ; pénalité et bornes.

## Données de démonstration (à créer, pas à saisir à la main vendredi)

Un festival « Les Nuits du Phare », 6 activités de types différents, 6 utilisateurs aux rôles distincts, 5 équipements dont 1 en quantité limitée, 6 affectations et 2 incidents. Préparez au moins **un cas qui fonctionne et un cas qui échoue** pour chacune de vos trois règles.

## Contrat API indicatif

```http
GET  /api/events
GET  /api/events/{id}
GET  /api/activities?eventId=1
POST /api/incidents
```

Précisez votre réponse JSON, ses statuts et ses droits avant de coder. Le travail peut rester principalement en HTML rendu côté serveur.

## Maquette : rendez l'organisation visible

Accueil public, programme, tableau de bord « jour J », fiche activité, écran d'affectation, formulaire d'incident, écran d'erreur métier. Le critère n'est pas le nombre d'animations : c'est la capacité à **comprendre en quelques secondes ce qui bloque le festival**.

## Pour les plus rapides

Vue calendrier, impression du conducteur, QR code de matériel **sans service payant**, audit détaillé, statistiques d'occupation. Les bonus ne remplacent jamais les 3 règles contractuelles et leurs tests.

**Histoire professionnelle à raconter au jury :** vous avez transformé un problème de coordination réelle en une application Web sécurisée, avec décisions de conception, processus métier, API, tests et maintenance.
