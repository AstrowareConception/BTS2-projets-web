# 28 — Traiter un incident remonté par un testeur

**Campagne de recette du jeudi 26 novembre 2026 — BTS SIO SLAM, PHP / Slim 4 / Medoo**

Vous recevez un **signalement**, pas la preuve qu'un défaut existe. Le testeur peut se tromper sur le compte utilisé, l'état d'une ressource, l'heure, le navigateur ou la succession des actions. Certaines caractéristiques techniques figurant dans le ticket sont sans rapport avec le problème. Votre travail est de distinguer **fait constaté, hypothèse, information manquante et comportement métier attendu**.

Une enquête solide peut aboutir à une correction **ou** à une conclusion « non reproduit dans les conditions testées, avec protections vérifiées ». Ne tentez pas de « faire apparaître » artificiellement un bug.

## 1. Accuser réception et qualifier

Dans votre dépôt personnel, créez une issue de suivi liée à l'issue reçue dans le dépôt pédagogique. Commencez par renseigner :

- Référence du signalement, fonctionnalité et règle métier concernée.
- Comportement **rapporté** (non confirmé) et comportement **attendu**.
- Impact potentiel : intégrité des données, sécurité, disponibilité, exploitation.
- Conditions connues, conditions manquantes et questions à poser au testeur.
- Hypothèses initiales et risques, sans présenter une supposition comme un diagnostic.

**Ne vous fiez pas exclusivement à l'écran.** Une vue ancienne, un état local ou une réponse visuelle trompeuse ne prouvent pas que la modification a été enregistrée.

## 2. Préparer un jeu d'essai reproductible

1. Travaillez sur votre **environnement et base de test**, avec des comptes et données fictifs.
2. Notez les identifiants des enregistrements, rôles, dates/heures, états et relations nécessaires.
3. Précisez comment remettre ce jeu d'essai à zéro ou le reconstruire.
4. Faites le parcours normal depuis l'interface Web.
5. Lorsque cela correspond à votre application, rejouez l'action par **requête HTTP directe** (curl, Bruno, Postman) pour vérifier les contrôles **côté serveur**.
6. Testez au moins deux variantes pertinentes : autre rôle, modification au lieu de création, cas limite horaire, état antérieur, second onglet, autre ressource…
7. Comparez les réponses HTTP **et la persistance réelle en SQL avant/après**.

Pour les règles temporelles, utilisez une date de référence connue ou des données horodatées en **base de test**. Ne modifiez pas l'horloge de production. Pour le CSRF, utilisez un compte/environnement de test, sans jamais communiquer son cookie de session.

## 3. Réunir des preuves vérifiables

| Preuve | Contenu minimal |
|---|---|
| Scénario | Préconditions, rôle, données, ordre exact des actions |
| HTTP | Méthode, URI, code de statut, extrait utile de la réponse |
| Persistance | Valeurs SQL avant/après, y compris après une requête refusée |
| Code | Couche qui décide : validation, service, repository, autorisation ou contrainte SQL |
| Reproductibilité | Nombre d'essais, variantes et résultats |
| Test durable | Test automatisé **ou** recette détaillée et rejouable |
| Traçabilité | Référence issue, commit si correction, version et date |

Masquez mots de passe, cookies, jetons CSRF, identifiants de session, secrets, données personnelles réelles et éléments appartenant à d'autres comptes.

## 4. Prendre une décision fondée sur les faits

### A — Défaut confirmé

- Décrivez le **scénario reproductible** et la cause racine.
- Si possible, écrivez un test qui échoue avant correction.
- Corrigez dans la bonne couche. Masquer un bouton ou avaler une exception ne remplace **jamais** le contrôle serveur.
- Rejouez le scénario en échec, son scénario autorisé et les règles voisines.
- Fournissez le commit et un test de non-régression qui restera dans le projet.

### B — Non reproduit, protections vérifiées

- Documentez la reproduction tentée et les variantes.
- Expliquez **quel code, quelle requête ou quelle contrainte SQL** empêche le comportement.
- Conservez un test démontrant le garde-fou.
- Mentionnez honnêtement les limites : concurrence non simulée, autre navigateur non vérifié, rôle absent, données non disponibles, etc.

**Formulation correcte :** « Non reproduit dans les conditions testées ; les contrôles suivants ont été vérifiés ; ces limites subsistent. »

**À proscrire :** « Impossible que cela arrive : mon code est 100 % safe. » Des tests finis ne prouvent pas l'absence de tous les bugs.

### C — Informations insuffisantes

Indiquez les éléments qui manquent, les expériences que vous avez tout de même conduites et les questions précises nécessaires à la reprise.

### D — Scénario non applicable

Si la fonctionnalité visée n'existe pas dans votre version, expliquez son périmètre et signalez-le à l'enseignant pour obtenir un cas alternatif **sur une fonctionnalité livrée**. N'inventez pas un résultat.

## 5. Communiquer au testeur

Répondez **dans le ticket de suivi**, en langage compréhensible :

> **Statut :** confirmé/corrigé, non reproduit avec contrôles vérifiés, informations complémentaires nécessaires, non applicable…  
> **Constat :** ce qui a réellement été observé.  
> **Conditions testées :** jeu de données, rôles, actions, variantes.  
> **Cause ou protection vérifiée :** explication synthétique.  
> **Correction :** réalisée et référence du commit, ou non nécessaire à ce stade.  
> **Preuves :** liens vers tests, captures, résultat SQL expurgé, logs utiles.  
> **Limites / prochaine action :** éléments encore non testés ou information à demander.

## 6. Critères de clôture

- [ ] Signalement qualifié sans présumer qu'il est vrai.
- [ ] Scénario reproductible **ou** non-reproduction méthodique et documentée.
- [ ] Rôle, HTTP et données persistantes vérifiés selon le contexte.
- [ ] Cause/correctif **ou** garde-fous et limites identifiés.
- [ ] Au moins un test conservé pour la suite.
- [ ] Traces et preuves sans secrets.
- [ ] Réponse professionnelle au testeur.
- [ ] Rapport individuel rempli : [modèle Markdown](../templates/RAPPORT_INCIDENT.md).

Vous n'êtes pas évalué sur le fait de trouver un défaut à tout prix, mais sur **la rigueur du diagnostic, la maîtrise du code et l'argumentation de votre conclusion**.
