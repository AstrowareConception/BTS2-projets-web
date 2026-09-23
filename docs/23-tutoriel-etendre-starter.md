# 23 — Tutoriel : étendre le starter

Objectif : ajouter une nouvelle ressource `Category` sans copier aveuglément `Equipment`.

## Étape 1 — Modèle de données

Ajoutez une table :

```sql
CREATE TABLE category (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);
```

Décidez ensuite comment `equipment` référence une catégorie.

## Étape 2 — Repository

Créez :

```text
src/Repository/CategoryRepository.php
```

Méthodes minimales :
- `all()`
- `find(int $id)`
- `create(string $name)`

## Étape 3 — Service

Créez :

```text
src/Service/CategoryService.php
```

Ajoutez au moins une règle :
- nom obligatoire ;
- nom suffisamment court ;
- pas de doublon.

La vraie question est : **quelle couche doit détecter chaque problème ?**

## Étape 4 — Contrôleur

Créez :

```text
src/Controller/CategoryController.php
```

Il doit traduire :
- requête HTTP → données ;
- service → résultat ;
- exception métier → réponse adaptée.

## Étape 5 — Routes

Ajoutez :

```http
GET /api/categories
GET /api/categories/{id}
POST /api/categories
```

## Étape 6 — Câblage

Dans `public/index.php` :

```php
$categoryRepository = new CategoryRepository($database);
$categoryService = new CategoryService($categoryRepository);
$categoryController = new CategoryController($categoryService);
```

Passez ensuite le contrôleur à votre fichier de routes ou adaptez votre organisation.

## Étape 7 — Test manuel

### Collection

```bash
curl http://127.0.0.1:8080/api/categories
```

### Création

```bash
curl -X POST http://127.0.0.1:8080/api/categories \
  -H "Content-Type: application/json" \
  -d '{"name":"Audiovisuel"}'
```

## Étape 8 — Cas d'erreur

Testez :
- nom vide ;
- doublon ;
- identifiant inexistant ;
- JSON invalide.

## Étape 9 — Refactor

Vous allez probablement voir apparaître des répétitions.

Ne créez pas immédiatement une « BaseRepository universelle » ou un « SuperController ».

Posez-vous d'abord :
- la répétition est-elle réellement problématique ?
- l'abstraction serait-elle plus simple ?
- puis-je l'expliquer ?

## Étape 10 — Transposer à votre sujet

Vous avez maintenant la méthode.

Appliquez-la à une vraie entité :
- Activity ;
- Reservation ;
- Room ;
- Incident ;
- Equipment ;
- User.

Puis introduisez vos règles métier dans les services.
