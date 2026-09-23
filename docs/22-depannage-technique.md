# 22 — Dépannage Slim + Medoo

## « Class ... not found »

Vérifiez :
1. namespace ;
2. chemin du fichier ;
3. casse du nom ;
4. mapping PSR-4 dans `composer.json`.

Puis :

```bash
composer dump-autoload
```

## Slim retourne 404 sur toutes mes routes

Vérifiez :
- que le serveur redirige vers `public/index.php` ;
- que vous utilisez le routeur local fourni ;
- que l'URL correspond exactement ;
- que la méthode HTTP est correcte.

Pour le starter :

```bash
composer serve
```

## « could not find driver »

Le pilote PDO correspondant n'est probablement pas activé.

Pour MySQL/MariaDB, vérifiez `pdo_mysql`.

```bash
php -m
```

## « Access denied for user »

Vérifiez :
- DB_HOST ;
- DB_PORT ;
- DB_NAME ;
- DB_USER ;
- DB_PASSWORD ;
- droits de l'utilisateur SQL.

Ne corrigez pas en mettant le compte root avec un mot de passe dans Git.

## Medoo retourne une liste vide

Avant d'accuser Medoo :
1. vérifiez les données dans la BDD ;
2. simplifiez le WHERE ;
3. vérifiez les noms de colonnes ;
4. vérifiez les types/valeurs ;
5. inspectez la requête générée si nécessaire.

## Mon POST est vide

Si vous utilisez JSON :
- `Content-Type: application/json` ;
- JSON valide ;
- `$app->addBodyParsingMiddleware()`.

Si vous utilisez un formulaire HTML :
- attribut `name` sur les champs ;
- méthode `post` ;
- route POST correspondante.

## Mon endpoint renvoie une page HTML d'erreur

Dans une API, attrapez les erreurs métier prévues et retournez un JSON cohérent.

Ne masquez cependant pas systématiquement les erreurs techniques en développement : vous devez pouvoir les diagnostiquer.

## « Headers already sent »

Vous avez probablement produit du contenu avant les en-têtes :
- `echo` ;
- espace avant `<?php` ;
- debug ;
- BOM dans un fichier.

Avec PSR-7, évitez les `echo` dans vos contrôleurs.

## J'ai une erreur 500

Procédure :
1. reproduire ;
2. regarder le terminal / logs ;
3. activer `APP_DEBUG=true` uniquement en développement ;
4. lire la stack trace ;
5. identifier le premier fichier de votre code dans la trace.

## Une règle fonctionne dans le Web mais pas dans l'API

Probable duplication de logique.

Déplacez la règle dans un service utilisé par les deux entrées.

## Ma requête devient énorme

Demandez-vous :
- puis-je créer une méthode de repository nommée selon le besoin ?
- ai-je besoin d'une vue SQL ?
- dois-je découper le calcul ?
- une requête SQL explicite serait-elle plus lisible ?

L'abstraction ne doit pas rendre le code incompréhensible.

## Mon projet est bloqué

Utilisez le format :

```text
Je cherche à :
J'obtiens :
Je devrais obtenir :
Route concernée :
Code concerné :
Erreur :
Hypothèses testées :
```

Avec ces informations, une aide devient beaucoup plus efficace.
