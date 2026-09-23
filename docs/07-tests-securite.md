# 07 — Tests, qualité & sécurité

## Tests minimum

Vous devez présenter une stratégie de test, pas simplement dire « j’ai cliqué partout ».

### Pour les règles contractuelles
Chaque règle possède au minimum :
- un cas nominal ;
- un cas limite ou refus ;
- un résultat attendu précis.

### Test automatisé
Vous devez produire plusieurs tests automatisés pertinents lorsque l’architecture le permet.

Priorité aux services métier et règles importantes plutôt qu’aux getters/setters.

### Recette
Complétez [le modèle de recette](../templates/RECETTE.md).

## Tests de non-régression

Après l’évolution et après l’incident, exécutez à nouveau les tests concernés. Ajoutez un test si le défaut révélait un cas non couvert.

## Sécurité minimale obligatoire

- mot de passe haché avec une fonction adaptée ;
- validation serveur ;
- requêtes paramétrées / couche d’accès aux données sûre ;
- contrôle des habilitations côté serveur ;
- protection contre les accès directs à une ressource interdite ;
- échappement des données affichées ;
- secrets hors dépôt ;
- cookies/session configurés proprement ;
- messages d’erreur ne révélant pas de secret.

## Journalisation

Vous devez journaliser au moins quelques événements utiles :

- connexion refusée ;
- action sensible ;
- erreur applicative importante ;
- incident pertinent pour le métier.

Les logs ne doivent pas contenir de mots de passe ou secrets.

## Vérification manuelle

Avant livraison, essayez volontairement :
- URL d’administration avec un compte simple ;
- identifiant inexistant ;
- paramètres manquants ;
- valeurs absurdes ;
- doublons ;
- conflit métier ;
- tentative d’accès à une ressource d’un autre utilisateur.
