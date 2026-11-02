# 06 — Votre API JSON Slim 4 : un contrat, pas du SQL publié

Votre site produit du HTML pour les utilisateurs. Il expose également une **petite interface JSON** pour un client indépendant (curl, script, puis éventuellement un client Java). Le **modèle métier et les repositories sont partagés**.

## Le minimum démontrable

- `GET /api/... ` : collection, 200 et un **tableau**, même vide ;
- `GET /api/.../{id}` : ressource, 200 ou 404 ;
- `POST /api/...` : création métier, 201 + `Location` + JSON ;
- une documentation des méthodes, entrées, sorties, droits et erreurs ;
- un test par endpoint, dont au moins un cas d'échec.

Exemples : activités d'un festival, machines d'un FabLab, sessions d'escape game. **L'API ne doit pas contourner la validation et les droits du site HTML.**

## HTTP : distinguer les situations

| Situation | Réponse |
|---|---|
| Corps JSON mal formé ou structure impossible à interpréter | **400** |
| `Content-Type` non pris en charge | **415** |
| Entrée compréhensible mais invalide selon le contrat/métier | **422** |
| Ressource absente | **404** |
| Non authentifié / non autorisé | **401 / 403** |
| Conflit de réservation ou capacité | **409** si votre contrat le prévoit |
| Création valide | **201 + Location** |
| Formulaire HTML POST réussi | **303 → GET** |

Ne retournez pas systématiquement 200, et n'affichez jamais une erreur SQL brute.

## Extrait de contrat à produire

| Méthode | URI | Auth | Corps | Succès | Erreurs |
|---|---|---|---|---|---|
| GET | /api/equipment | selon données | — | 200 + [] | 401/403 |
| GET | /api/equipment/{id} | selon données | — | 200 + objet | 404 |
| POST | /api/incidents | rôle autorisé | JSON | 201 + Location | 400/415/422/403 |

## Niveau REST visé

**Richardson niveau 2** comme cible pédagogique : ressources identifiées, méthodes et statuts cohérents. L'hypermédia/HATEOAS constitue une étude ou un bonus ; son absence ne rend pas votre travail inutile.

REST comporte d'autres contraintes (dont stateless). Si votre API dépend de la session PHP serveur pour reconnaître le client, ne prétendez pas à une conformité stricte à toutes les contraintes REST : **décrivez honnêtement l'architecture utilisée**.

## Tests

Testez avec `curl -i`, Bruno, Postman ou un script, en montrant **en-têtes, statut et corps** ; un JSON lisible ne suffit pas.

Pour un contrat OpenAPI plus complet, utilisez [les ressources](21-ressources-externes.md). OpenAPI reste un bonus.
