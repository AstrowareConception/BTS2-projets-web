# 05 — Git & gestion de projet

Votre historique Git est une preuve de votre travail.

## Minimum attendu

- dépôt créé dès lundi ;
- `README.md` exploitable ;
- commits réguliers ;
- messages compréhensibles ;
- issues ou backlog ;
- branches pour les évolutions significatives ;
- tags ou releases ;
- aucun secret dans le dépôt.

## Exemples de bons commits

```text
feat(auth): ajouter la connexion et les rôles
feat(booking): empêcher une réservation sur une ressource indisponible
test(booking): couvrir les conflits de créneaux
fix(api): retourner 404 quand la ressource est absente
docs: documenter la procédure de déploiement
```

## À éviter

```text
maj
test
ça marche
final
final2
dernier
vraiment-final
```

## Issues recommandées

Chaque règle métier contractuelle doit avoir sa propre issue.

Créez également des issues pour :

- mise en place du socle ;
- maquettes ;
- authentification ;
- API ;
- tests ;
- déploiement ;
- évolution client ;
- incident.

## Definition of Done d’une issue

Une issue ne passe à « terminé » que lorsque :

- le code est intégré ;
- la règle est vérifiée ;
- les tests pertinents passent ;
- la documentation impactée est à jour ;
- aucun secret n’est introduit.
