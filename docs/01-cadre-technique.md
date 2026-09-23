# 01 — Cadre technique commun

Les trois sujets utilisent le même cadre afin que l’évaluation porte sur la qualité de votre démarche et non sur la technologie choisie.

## Stack attendue

- PHP 8+
- Composer
- Slim
- architecture MVC
- Medoo ou PDO pour l’accès aux données
- MySQL ou MariaDB
- HTML / CSS ; framework CSS autorisé
- JavaScript autorisé mais non requis
- Git + dépôt distant
- API REST en JSON
- environnement de développement local reproductible

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

## Ce qui est interdit

- application réduite à une suite de CRUD sans logique métier ;
- copier intégralement le projet d’un autre étudiant ;
- remplacer la conception par du code généré sans compréhension ;
- stocker des mots de passe en clair ;
- committer des secrets ;
- désactiver les contrôles de sécurité pour « faire marcher » l’application ;
- attendre vendredi pour pousser le code.
