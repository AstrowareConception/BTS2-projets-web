# 19 — Slim + Medoo : les utiliser ensemble

Slim et Medoo n'ont pas le même rôle.

```text
Slim
= HTTP / routes / middleware / Request / Response

Medoo
= accès à la base SQL
```

Ils ne doivent donc pas être mélangés dans une seule énorme fonction.

## Architecture recommandée pour la semaine

```text
routes/
   ↓
Controller
   ↓
Service
   ↓
Repository
   ↓
Medoo
   ↓
BDD
```

## Exemple complet : créer un équipement

### 1. Route

```php
$group->post('/equipment', [$controller, 'apiCreate']);
```

La route décide **où entre la requête**.

### 2. Contrôleur

```php
public function apiCreate($request, $response)
{
    $data = $request->getParsedBody();

    $equipment = $this->service->create(
        is_array($data) ? $data : []
    );

    return JsonResponder::respond(
        $response,
        ['data' => $equipment],
        201
    );
}
```

Le contrôleur traduit le monde HTTP vers l'application.

### 3. Service

```php
public function create(array $input): array
{
    $name = trim((string) ($input['name'] ?? ''));

    if ($name === '') {
        throw new InvalidArgumentException(
            'Le nom est obligatoire.'
        );
    }

    return $this->repository->create($name);
}
```

Le service porte la **règle métier / validation applicative**.

### 4. Repository

```php
public function create(string $name): array
{
    $this->database->insert('equipment', [
        'name' => $name,
    ]);

    return $this->find(
        (int) $this->database->id()
    );
}
```

Le repository sait comment persister l'information.

## Une règle métier plus intéressante

Supposons :

> Un équipement possédant un incident critique ouvert ne peut pas être réservé.

Le contrôleur ne devrait pas contenir la règle.

```php
public function reserve(
    int $equipmentId,
    int $userId,
    DateTimeImmutable $start,
    DateTimeImmutable $end
): array {
    if ($this->incidentRepository->hasBlockingIncident($equipmentId)) {
        throw new DomainException(
            'Cet équipement est bloqué par un incident critique.'
        );
    }

    if ($this->reservationRepository->hasOverlap(
        $equipmentId,
        $start,
        $end
    )) {
        throw new DomainException(
            'Ce créneau est déjà réservé.'
        );
    }

    return $this->reservationRepository->create(...);
}
```

Ici, le code raconte le métier.

## Câblage manuel

Le starter crée les objets explicitement :

```php
$database = DatabaseFactory::create($settings['database']);

$repository = new EquipmentRepository($database);
$service = new EquipmentService($repository);
$controller = new EquipmentController($service, $renderer);
```

Pourquoi ne pas ajouter immédiatement un conteneur de dépendances ?

Parce que ce câblage est :
- visible ;
- compréhensible ;
- suffisant pour votre taille de projet.

Un conteneur pourra être étudié plus tard si le projet le justifie.

## Web et API sur les mêmes services

Vous pouvez avoir :

```text
Vue HTML ────┐
             ├── Controller ── Service ── Repository ── BDD
API JSON ────┘
```

Le plus important est d'éviter de dupliquer vos règles métier entre l'interface Web et l'API.

Si une réservation est interdite, elle doit être interdite :
- depuis un formulaire ;
- depuis l'API ;
- demain depuis JavaFX.

La règle doit donc vivre dans le service métier, pas dans le bouton HTML.

## À retenir

Slim reçoit et répond.

Medoo persiste.

Le contrôleur orchestre l'entrée/sortie.

Le service fait respecter le métier.

Le repository dialogue avec les données.
