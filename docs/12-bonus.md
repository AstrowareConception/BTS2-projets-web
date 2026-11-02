# 12 — Bonus, après stabilisation du socle

**Ne choisissez pas un bonus qui exige de refaire votre architecture.** Les trois règles contractuelles, la sécurité, l'évolution et la recette passent avant.

## Des bonus qui rendent le produit plus vivant

- **Backstage :** conducteur imprimable, calendrier de bénévoles, vue « 30 minutes avant ouverture », badge des urgences.
- **RepairLab :** fiche équipement par QR code, CSV d'inventaire, historique machine imprimable, indicateur de réparation.
- **EscapeOps :** mode « cockpit » grand écran, calendrier des sessions, suivi de retard, QR code d'accueil fictif.

## Bonus de qualité

- tests automatisés du domaine (PHPUnit) ;
- automatisation des tests dans GitHub Actions ;
- analyse statique PHPStan, rapport de couverture et explication des cas non couverts ;
- audit des dépendances Composer ;
- migration SQL versionnée ;
- OpenAPI décrivant les endpoints réellement exposés ;
- CI de syntaxe, tests et checks de sécurité ;
- interface responsive et accessible ;
- pagination et filtres combinés ;
- Docker Compose local lorsque utile.

## Bonus d'architecture

- interface de repository échangeable ;
- tests avec une base isolée ;
- service transactionnel pour un vrai scénario de concurrence ;
- cache HTTP sur des ressources publiques sans donnée sensible ;
- hypermédia/HATEOAS **si vous pouvez expliquer ce qu'un client fait des liens**, pas pour afficher `_links` décorativement.

## Ce qui n'est pas un bonus

Les mots de passe hachés, la vérification des autorisations, le CSRF sur formulaires authentifiés, l'échappement HTML, la validation serveur, les requêtes paramétrées et les secrets hors dépôt sont **obligatoires**.

Un bon bonus doit répondre à une vraie question client ou améliorer la fiabilité observable du produit.
