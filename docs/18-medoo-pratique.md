# 18 — Medoo : guide pratique

Medoo est une bibliothèque légère d'accès aux bases SQL construite au-dessus de PDO.

Documentation officielle : https://medoo.in/doc

Installation :

```bash
composer require catfan/medoo
```

## 1. Connexion

```php
use Medoo\Medoo;

$database = new Medoo([
    'type' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'my_database',
    'username' => 'user',
    'password' => 'secret',
    'charset' => 'utf8mb4',
]);
```

Dans votre projet, ne laissez pas les identifiants directement dans le code : utilisez la configuration d'environnement.

## 2. SELECT

```php
$items = $database->select('equipment', [
    'id',
    'name',
    'status',
], [
    'status' => 'AVAILABLE',
    'ORDER' => ['name' => 'ASC'],
]);
```

## 3. GET : une seule ligne

```php
$item = $database->get('equipment', [
    'id',
    'name',
    'status',
], [
    'id' => $id,
]);
```

## 4. INSERT

```php
$database->insert('equipment', [
    'name' => 'Projecteur',
    'status' => 'AVAILABLE',
]);

$id = (int) $database->id();
```

## 5. UPDATE

```php
$database->update('equipment', [
    'status' => 'MAINTENANCE',
], [
    'id' => $id,
]);
```

## 6. DELETE

```php
$database->delete('equipment', [
    'id' => $id,
]);
```

Avant de supprimer une donnée métier, demandez-vous si le besoin ne demande pas plutôt :
- un statut ;
- un archivage ;
- une conservation historique.

## 7. Conditions WHERE

Medoo possède une syntaxe structurée pour les conditions.

```php
$rows = $database->select('reservation', '*', [
    'AND' => [
        'equipment_id' => $equipmentId,
        'status' => ['CONFIRMED', 'PENDING'],
        'start_at[<]' => $requestedEnd,
        'end_at[>]' => $requestedStart,
    ],
]);
```

Cet exemple est particulièrement utile pour détecter un chevauchement temporel.

Documentation : https://medoo.in/api/where

## 8. JOIN

Exemple :

```php
$rows = $database->select('reservation', [
    '[>]user' => ['user_id' => 'id'],
    '[>]equipment' => ['equipment_id' => 'id'],
], [
    'reservation.id',
    'reservation.start_at',
    'user.name(user_name)',
    'equipment.name(equipment_name)',
]);
```

Ne créez pas des JOIN gigantesques par principe. Utilisez-les lorsque la requête métier le justifie.

## 9. Agrégations

```php
$count = $database->count('incident', [
    'equipment_id' => $equipmentId,
    'status[!]' => 'CLOSED',
]);
```

Medoo fournit également `sum`, `avg`, `min` et `max`.

## 10. Transactions

Une règle métier peut nécessiter plusieurs écritures qui doivent réussir ensemble.

Exemple conceptuel :

```php
$database->action(function ($database) use ($reservationData) {
    $database->insert('reservation', $reservationData);
    $database->update('equipment', [
        'last_reserved_at' => date('Y-m-d H:i:s'),
    ], [
        'id' => $reservationData['equipment_id'],
    ]);
});
```

Si votre règle métier exige une atomicité, expliquez pourquoi vous utilisez une transaction.

## 11. Requête SQL brute

Medoo permet d'exécuter du SQL plus directement, mais ne basculez pas vers des concaténations dangereuses.

Une requête complexe justifiée vaut mieux qu'une acrobatie illisible avec une abstraction. Dans ce cas :
- paramètres ;
- documentation ;
- test ;
- justification.

## 12. Repository

Évitez d'appeler Medoo partout.

### À éviter

```php
// contrôleur
$database->select(...);

// puis vue
$database->get(...);

// puis autre contrôleur
$database->update(...);
```

### Préférer

```php
final class EquipmentRepository
{
    public function find(int $id): ?array { ... }

    public function findAvailable(): array { ... }

    public function saveStatus(int $id, string $status): void { ... }
}
```

Le repository centralise les besoins d'accès aux données.

## 13. Débogage

Medoo fournit des outils de débogage et permet d'accéder au PDO sous-jacent. Utilisez-les pour comprendre, pas pour laisser des dumps en production.

## 14. Documentation officielle utile

- Documentation : https://medoo.in/doc
- Installation / configuration : https://medoo.in/api/new
- WHERE : https://medoo.in/api/where
- SELECT : https://medoo.in/api/select
- INSERT : https://medoo.in/api/insert
- UPDATE : https://medoo.in/api/update
- DELETE : https://medoo.in/api/delete
- JOIN : https://medoo.in/api/join
- COUNT : https://medoo.in/api/count
- Transaction `action` : https://medoo.in/api/action
- PDO : https://medoo.in/api/pdo
