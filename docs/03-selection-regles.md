# 03 — Sélection des règles métier

Chaque sujet contient **10 règles métier candidates**.

## Vous devez sélectionner

### 3 règles contractuelles

Elles font partie du cahier des charges ferme. Elles doivent être terminées, testées et démontrables.

### 3 règles d’extension

Elles constituent votre backlog secondaire. Vous les réalisez lorsque le socle et les règles contractuelles sont stabilisés.

## Unicité obligatoire

Deux étudiants ne peuvent pas avoir **la même combinaison de trois règles contractuelles sur un même sujet**.

L’ordre ne compte pas :

`R2 + R4 + R7` est la même combinaison que `R7 + R2 + R4`.

La combinaison est réservée après validation par l’enseignant.

## Contraintes de sélection

Vos trois règles contractuelles doivent :

- provenir d’au moins **deux familles** différentes ;
- contenir au moins **une règle multi-entités** ;
- ne pas être choisies uniquement pour leur facilité.

Chaque fiche sujet indique les familles et le caractère multi-entités.

## Pourquoi ?

Une règle métier intéressante doit modifier le comportement du système. Elle peut par exemple :

- bloquer une action ;
- faire changer l’état de plusieurs objets ;
- calculer une information ;
- imposer un quota ;
- déclencher une conséquence ;
- gérer un conflit ;
- imposer une autorisation ;
- conserver une trace.

## Preuves obligatoires

Pour chaque règle contractuelle, créez dans `docs/regles/` un fichier indiquant :

- formulation ;
- entités concernées ;
- emplacement du code ;
- scénarios de test ;
- captures ou éléments de preuve ;
- commits principaux.

Utilisez [le modèle de choix](../templates/CHOIX_REGLES.md).
