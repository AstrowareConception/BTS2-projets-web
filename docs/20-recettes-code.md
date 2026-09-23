# 20 — Recettes de code utiles

Ces recettes sont des **points de départ**, pas du code à copier sans réfléchir.

## Retourner un 404 JSON

```php
$item = $service->get($id);

if ($item === null) {
    return JsonResponder::respond($response, [
        'error' => 'NOT_FOUND',
        'message' => 'Ressource introuvable.',
    ], 404);
}
```

## Validation simple

```php
$name = trim((string) ($data['name'] ?? ''));

if ($name === '') {
    throw new InvalidArgumentException(
        'Le nom est obligatoire.'
    );
}
```

## Contrôle d'une valeur fermée

```php
$allowed = ['OPEN', 'IN_PROGRESS', 'CLOSED'];

if (!in_array($status, $allowed, true)) {
    throw new InvalidArgumentException(
        'Transition ou statut invalide.'
    );
}
```

## Détecter un chevauchement

Deux intervalles `[A, B]` et `[C, D]` se chevauchent si :

```text
A < D ET B > C
```

Avec Medoo :

```php
$count = $database->count('reservation', [
    'AND' => [
        'equipment_id' => $equipmentId,
        'start_at[<]' => $requestedEnd,
        'end_at[>]' => $requestedStart,
        'status' => ['PENDING', 'CONFIRMED'],
    ],
]);

$hasOverlap = $count > 0;
```

## Échapper une donnée HTML

```php
<?= htmlspecialchars(
    $user['name'],
    ENT_QUOTES,
    'UTF-8'
) ?>
```

## Hacher un mot de passe

```php
$hash = password_hash(
    $password,
    PASSWORD_DEFAULT
);
```

Vérifier :

```php
if (!password_verify($password, $hash)) {
    // refus
}
```

## Regénérer l'identifiant de session après connexion

```php
session_regenerate_id(true);
```

## Lire un JSON via Slim

Avec `addBodyParsingMiddleware()` :

```php
$data = $request->getParsedBody();

if (!is_array($data)) {
    $data = [];
}
```

## Pagination simple

```php
$page = max(1, (int) ($params['page'] ?? 1));
$limit = 20;
$offset = ($page - 1) * $limit;
```

Puis utilisez `LIMIT` avec votre requête Medoo.

## Recherche

Avant de développer :
- quels champs ?
- recherche exacte ou partielle ?
- accents/casse ?
- pagination ?
- performances ?

## Log applicatif minimal

```php
error_log(sprintf(
    '[INCIDENT] equipment=%d user=%d',
    $equipmentId,
    $userId
));
```

Pour un vrai projet, structurez vos logs et ne journalisez jamais de mot de passe, token ou secret.

## Dates

Préférez des objets :

```php
$start = new DateTimeImmutable($input['start_at']);
$end = new DateTimeImmutable($input['end_at']);

if ($end <= $start) {
    throw new InvalidArgumentException(
        'La fin doit être postérieure au début.'
    );
}
```

## Transaction

Utilisez une transaction lorsque plusieurs écritures forment une seule opération logique.

Exemple : réservation + mouvement de stock + historique.

## Règle essentielle

Une recette devient du bon code seulement si :
- elle répond à votre besoin ;
- vous la comprenez ;
- vous la testez ;
- vous savez expliquer ses limites.
