# 26 — Préparer des tests qui racontent une histoire

## Avant de coder une règle

Remplissez une petite fiche :

| Question | Exemple EscapeOps |
|---|---|
| Quel acteur ? | Responsable |
| Quelle action ? | Créer une session |
| Quel contexte ? | Salle déjà occupée, besoin de 20 min de remise en état |
| Quelle règle ? | E4 |
| Résultat heureux ? | Démarrage après le délai |
| Résultat refusé ? | Créneau trop proche |
| Quelles entités ? | Salle et session |
| Quelle preuve ? | Capture du message + cas de recette |

## Minimum de chaque règle contractuelle

- **1 scénario positif** avec données d'entrée et résultat attendu.
- **1 scénario négatif** où l'action doit être refusée ou produire une conséquence particulière.
- **1 cas limite** lorsque pertinent (exactement 24 h, exactement 15 min, capacité maximale, etc.).
- Une réponse claire de l'application, sans erreur PHP brute.
- Une preuve : capture, test automatisé, requête HTTP ou extrait de BDD vérifié.

## Tests de niveau HTTP déjà étudiés

| Action | Réponse attendue |
|---|---|
| GET collection vide | 200 et tableau JSON vide |
| GET identifiant inconnu | 404, pas 500 |
| POST création JSON valide | 201, Location et objet JSON |
| POST corps malformé | 400 |
| POST autre Content-Type | 415 |
| POST JSON valide mais règle violée | 422 ou 409 selon le contrat |
| Formulaire HTML POST réussi | 303 puis GET |
| Formulaire sans CSRF | 403 |
| Action réservée à un autre rôle | 403 |
| DELETE API réussi (si exposé) | 204, corps vide |

**Ne confondez pas** la page HTML et une API JSON. Leur représentation diffère ; les règles métier restent identiques.

## Montrer les erreurs métier avec fierté

La démonstration ne consiste pas seulement à montrer « ça marche ». Les meilleurs moments sont souvent les refus : une réservation doublée, un rôle insuffisant, une machine bloquée, un festival non prêt, un code 409 documenté.

## Tests automatisés (niveau conseillé)

Un test de modèle/service par règle sensible et quelques tests de repositories / routes sont préférables à dix tests artificiels. Les scripts `curl -i` et une recette détaillée constituent déjà des preuves utiles ; PHPUnit est un prolongement solide.

## Jeu de données

Conservez :
- un script SQL de création ;
- un script de données de démonstration fictives ;
- au moins une situation « correcte » et une « impossible » ;
- une procédure de remise à zéro du jeu d'essai.

Le vendredi, vous ne devez pas improviser les personnes, les horaires et les incidents depuis une base vide.

## Démonstration finale — 7 minutes maximum

1. **40 s :** organisation cliente et problème.
2. **50 s :** maquette, architecture et base de données.
3. **2 min 30 :** parcours métier et trois règles (dont deux refus).
4. **1 min :** API HTML/JSON et sécurité.
5. **1 min :** évolution et incident, preuve de non-régression.
6. **1 min :** tests, déploiement, limites et perspectives.

Préparez un ordre de démonstration **avant** vendredi, sans apprendre un discours par cœur.
