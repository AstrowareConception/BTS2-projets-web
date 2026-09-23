# 06 — API REST

Chaque projet expose une petite API JSON. L’objectif est de préparer de vrais échanges inter-applicatifs et de permettre une réutilisation ultérieure, notamment depuis une application Java.

## Minimum commun

Au moins :

- une collection en lecture ;
- une ressource en lecture ;
- une création ou action métier ;
- gestion des erreurs ;
- codes HTTP cohérents ;
- JSON valide.

Exemple générique :

```http
GET /api/resources
GET /api/resources/{id}
POST /api/incidents
```

## Attendus

### Codes HTTP
Utilisez notamment :
- `200` succès ;
- `201` création ;
- `400` requête invalide ;
- `401` non authentifié ;
- `403` interdit ;
- `404` absent ;
- `409` conflit lorsque pertinent ;
- `422` données non acceptables lorsque pertinent.

### Réponses d’erreur

Évitez les pages HTML d’erreur dans l’API.

```json
{
  "error": "SLOT_UNAVAILABLE",
  "message": "Le créneau demandé n'est plus disponible."
}
```

### Documentation

Ajoutez `docs/api.md` avec :
- endpoints ;
- paramètres ;
- exemples de requête ;
- exemples de réponse ;
- erreurs possibles ;
- authentification éventuelle.

## Bonus

Un contrat OpenAPI propre est un bonus, mais seulement si l’API de base est correcte.
