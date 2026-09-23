# 17 — Slim 4 : guide pratique

Slim est un **micro-framework HTTP**. Il ne décide pas de toute votre architecture : il fournit surtout le routage, les objets Request/Response et le mécanisme de middleware.

Documentation officielle : https://www.slimframework.com/docs/v4/

## 1. Le cycle d'une requête

```text
Navigateur / client
      ↓
public/index.php
      ↓
Slim trouve une route
      ↓
callback / contrôleur
      ↓
Response
      ↓
Navigateur / client
```

Une route associe :
- une méthode HTTP ;
- une URL ;
- du code à exécuter.

## 2. Route simple

```php
$app->get('/hello/{name}', function ($request, $response, array $args) {
    $response->getBody()->write('Bonjour ' . $args['name']);

    return $response;
});
```

## 3. Les principales méthodes

```php
$app->get('/equipment', ...);
$app->post('/equipment', ...);
$app->put('/equipment/{id}', ...);
$app->patch('/equipment/{id}', ...);
$app->delete('/equipment/{id}', ...);
```

Ne choisissez pas une méthode au hasard : sa sémantique doit correspondre à l'action HTTP.

## 4. Paramètres de route

```php
$app->get('/users/{id:[0-9]+}', function ($request, $response, $args) {
    $id = (int) $args['id'];

    // ...
});
```

Le motif `[0-9]+` empêche ici une valeur non numérique de correspondre à la route.

## 5. Query string

URL :

```text
/equipment?status=AVAILABLE&search=laser
```

Lecture :

```php
$params = $request->getQueryParams();

$status = $params['status'] ?? null;
$search = $params['search'] ?? null;
```

## 6. Corps de requête

Avec le middleware de parsing :

```php
$app->addBodyParsingMiddleware();
```

vous pouvez récupérer un formulaire ou un JSON :

```php
$data = $request->getParsedBody();
$data = is_array($data) ? $data : [];
```

## 7. Réponse JSON

```php
$payload = json_encode(
    ['data' => $items],
    JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
);

$response->getBody()->write($payload);

return $response
    ->withHeader('Content-Type', 'application/json; charset=utf-8')
    ->withStatus(200);
```

Le starter fournit `JsonResponder` pour éviter de répéter ce code.

## 8. Groupes de routes

```php
$app->group('/api', function ($group) {
    $group->get('/equipment', ...);
    $group->post('/equipment', ...);
});
```

On obtient :
- `GET /api/equipment`
- `POST /api/equipment`

## 9. Middleware

Un middleware exécute du code autour d'une requête.

Usages classiques :
- authentification ;
- autorisation ;
- logs ;
- CORS ;
- CSRF ;
- mesure du temps ;
- ajout d'en-têtes.

Exemple pédagogique :

```php
$requireLogin = function ($request, $handler) {
    if (empty($_SESSION['user_id'])) {
        throw new RuntimeException('Authentification requise');
    }

    return $handler->handle($request);
};

$app->get('/admin', ...)->add($requireLogin);
```

Dans votre projet final, traitez proprement la réponse plutôt que de lancer une exception générique.

## 10. Gestion des erreurs

En développement :

```php
$app->addErrorMiddleware(true, true, true);
```

En production, les détails d'erreur ne doivent normalement pas être affichés au client.

Le starter utilise `APP_DEBUG` pour séparer ces environnements.

## 11. Une route ne doit pas devenir votre application entière

### Mauvais

```php
$app->post('/booking', function (...) {
    // 80 lignes :
    // SQL
    // règles métier
    // validation
    // HTML
    // mails
});
```

### Mieux

```text
Route
  ↓
BookingController
  ↓
BookingService
  ↓
BookingRepository
```

Slim gère l'entrée HTTP. Votre domaine métier doit rester lisible indépendamment du framework.

## 12. Documentation officielle utile

- Installation : https://www.slimframework.com/docs/v4/start/installation.html
- Routage : https://www.slimframework.com/docs/v4/objects/routing.html
- Request : https://www.slimframework.com/docs/v4/objects/request.html
- Response : https://www.slimframework.com/docs/v4/objects/response.html
- Middleware : https://www.slimframework.com/docs/v4/concepts/middleware.html
- Routing middleware : https://www.slimframework.com/docs/v4/middleware/routing.html
- Error middleware : https://www.slimframework.com/docs/v4/middleware/error-handling.html
