# 01 — Cadre technique commun

Les trois sujets utilisent le même cadre afin que l’évaluation porte sur la qualité de votre démarche et non sur la technologie choisie.

## Stack attendue

- PHP 8.2+
- Composer
- Slim 4
- architecture MVC
- Medoo pour l’accès aux données (au-dessus de PDO)
- MySQL ou MariaDB
- HTML / CSS ; framework CSS autorisé
- JavaScript autorisé mais non requis
- Git + dépôt distant
- API REST en JSON
- environnement de développement local reproductible

## Starter Kit

Un [Starter Kit Slim + Medoo](../starter-kit/README.md) est fourni.

Il est là pour :
- gagner du temps sur l’initialisation ;
- montrer une organisation possible ;
- donner un exemple de routes Web et API ;
- montrer la circulation entre contrôleur, service et repository ;
- fournir un exemple concret d’utilisation de Medoo ;
- fournir une configuration `.env`.

Il n’est **pas** là pour faire le projet à votre place.

Vous devez adapter :
- les entités ;
- le modèle de données ;
- les règles métier ;
- les services ;
- les contrôleurs ;
- les routes ;
- les vues ;
- la sécurité.

## Architecture minimale

Vous devez séparer clairement :

- routes ;
- contrôleurs ;
- services métier lorsque la logique le justifie ;
- accès aux données ;
- vues ;
- configuration.

Exemple indicatif :

```text
src/
  Controller/
  Service/
  Repository/
  Model/
templates/
public/
config/
tests/
docs/
```

Cette arborescence peut être adaptée, mais vous devez être capable de justifier vos choix.

## Principe de séparation

```text
HTTP
 ↓
Slim / routes
 ↓
Controller
 ↓
Service métier
 ↓
Repository
 ↓
Medoo
 ↓
BDD
```

Une règle métier importante ne doit pas exister uniquement dans un formulaire ou dans une route. Elle doit être réutilisable depuis :
- l’interface Web ;
- l’API ;
- potentiellement plus tard un client JavaFX.

## Exigences fonctionnelles communes

Toutes les réalisations doivent comporter :

1. une partie publique utile ;
2. une authentification ;
3. au moins trois niveaux ou profils d’accès réellement différenciés ;
4. un tableau de bord authentifié ;
5. plusieurs entités liées en base ;
6. au moins une relation plusieurs-à-plusieurs ;
7. des règles métier non triviales ;
8. une recherche ou un filtrage utile ;
9. une API REST ;
10. un historique ou une traçabilité sur une partie pertinente du métier.

## Données

La base doit comporter suffisamment de richesse pour démontrer :

- clés primaires et étrangères ;
- contraintes ;
- relations ;
- jointures ;
- agrégations ;
- requêtes métier ;
- index lorsque justifié ;
- sauvegarde et restauration.

Le nombre de tables n’est pas un objectif. **Une base cohérente de 6 à 10 tables utiles vaut mieux qu’une base de 25 tables artificielles.**

## Documentation technique disponible

Pendant la semaine, utilisez en priorité :

- [Slim pratique](17-slim-pratique.md)
- [Medoo pratique](18-medoo-pratique.md)
- [Slim + Medoo](19-slim-medoo-ensemble.md)
- [Recettes de code](20-recettes-code.md)
- [Ressources externes](21-ressources-externes.md)
- [Dépannage](22-depannage-technique.md)

## Ce qui est interdit

- application réduite à une suite de CRUD sans logique métier ;
- copier intégralement le projet d’un autre étudiant ;
- copier le starter sans savoir expliquer son architecture ;
- remplacer la conception par du code généré sans compréhension ;
- stocker des mots de passe en clair ;
- committer des secrets ;
- désactiver les contrôles de sécurité pour « faire marcher » l’application ;
- attendre vendredi pour pousser le code.
