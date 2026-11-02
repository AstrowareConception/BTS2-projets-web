# 07 — Tester et sécuriser la réalisation

La [méthode de préparation des scénarios](26-tests-et-demonstration.md) et les fiches sujets précisent le **cas positif, le refus et le cas limite** de chacune des 30 règles candidates.

## Pourquoi les tests sont importants

Vous ne prouvez pas seulement que le bouton fonctionne : vous prouvez qu'une action interdite **reste interdite même si l'on contourne le formulaire**.

### Minimum

Pour chaque règle contractuelle :
- un scénario accepté ;
- un scénario refusé ;
- un cas limite si pertinent ;
- preuve du résultat côté interface ou API ;
- justification du composant qui applique la règle.

Ajouter une recette de connexion, un contrôle d'accès direct, un test CSRF et un test API. Les tests automatisés sont fortement encouragés lorsque la structure du code le permet.

## Testez le métier dans le bon composant

Une règle durable doit être portée par un modèle/service ; un repository ne choisit pas les codes HTTP ; un contrôleur ne doit pas être un assemblage de SQL et HTML. La séparation rend les tests possibles.

## Vérifications de sécurité incontournables

- `password_hash()`, `password_verify()` et régénération de session à la connexion ;
- vérification des **rôles serveur** pour chaque écriture sensible ;
- `CSRF` sur les actions HTML authentifiées reposant sur les cookies ;
- validation **des types**, formats, valeurs et longueurs des entrées ;
- SQL paramétré via PDO/Medoo, jamais concaténation ;
- `htmlspecialchars` dans les vues ;
- secrets ignorés par Git ;
- cookies de session configurés selon le contexte (Secure sous HTTPS, HttpOnly, SameSite) ;
- erreurs techniques journalisées, non affichées au public.

### Scénarios de sécurité

1. Accédez à une URL protégée avec un autre rôle : refus.
2. Retirez le jeton CSRF d'un POST de formulaire : **403**.
3. Envoyez une valeur tableau à la place d'une chaîne : aucun crash.
4. Essayez un identifiant inexistant : **404**, pas une panne SQL.
5. Affichez une saisie contenant des caractères HTML : texte échappé.
6. Testez un conflit horaire/stock si votre règle l'exige : refus métier clair.

## Intégration et non-régression

Mercredi : ajouter un test correspondant à la nouvelle demande.  
Jeudi : reproduire le défaut, corriger, rejouer les parcours existants et conserver un test qui aurait détecté le problème.

Les cours détaillent les distinctions **validation / normalisation / échappement**, les transactions et les tests de contrôleurs. Voir [la table des pages](24-ponts-avec-les-cours.md).
