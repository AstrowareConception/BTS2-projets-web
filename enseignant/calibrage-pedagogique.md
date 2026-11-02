# Note de calibrage — édition novembre 2026

Cette note est réservée au pilotage pédagogique. Attention : dans un dépôt public, **le dossier enseignant reste lisible par les étudiants**. Les cartes surprises détaillées peuvent être communiquées le jour voulu ou déplacées dans un espace privé.

## Pourquoi la formule a été revue

Les quatre cours reçus couvrent : HTTP/formulaires/sessions ; PDO, SQL et transactions ; MVC et Slim ; REST, contrat JSON et Richardson. Medoo est un **complément documentaire** au PDO, non un prérequis issu de ces quatre PDF.

La première version des sujets avait plusieurs risques :
- règles impossibles sans une autre règle optionnelle ;
- duplication entre invariant de base et règle choisie ;
- automatisations de type cron/IoT/paiement non étudiées ;
- trop de fonctionnalités simultanées dans cinq jours solo ;
- démonstrations et tests insuffisamment décrits.

## Les arbitrages

- Trois univers inchangés, mais **scénarios clients crédibles et incarnés**.
- Socle réduit à 6–9 entités utiles ; l'étudiant crée une table optionnelle uniquement lorsque sa règle le nécessite.
- Dix règles avec **complexité indiquée, scénario testable et cas de refus**, chacune réalisable depuis le socle.
- Trois règles contractuelles **terminées** et trois extensions **réservées** ; une extension achevée est un objectif positif, non un moyen de pénaliser celui qui termine correctement sa RP.
- L'évolution du mercredi doit prendre environ **une tranche de développement réaliste**, pas obliger à faire une règle avancée entière en plus.
- L'incident du jeudi doit viser **un comportement réellement implémenté**, et non simuler un défaut sur une fonctionnalité absente.
- API Slim : niveau 2 Richardson cible, OpenAPI / HATEOAS bonus. Une API avec HTML session ne se revendique pas « REST strict stateless » si son contrat dépend d'une session.
- Aucune promesse de « validation automatique E4/E5 » : fournir preuves et autonomie d'explication.

## Grille de choix des trois règles

Validation du triplet :
- au moins deux familles ;
- au moins une règle reposant sur la relation de plusieurs entités ;
- au moins **une règle de difficulté intermédiaire ou avancée** ;
- règle avancée conseillée plutôt en extension aux étudiants fragiles ;
- même triplet interdit pour deux étudiants sur le même sujet.

En cas de doute, **faire expliquer par l'étudiant la démonstration possible vendredi** avant de valider.

## Politique de changement mercredi

Évolution = un besoin nouveau, de préférence issu de l'une des quatre règles non retenues, **mais calibré à une seule tranche verticale**. Exemple : rajouter une date limite, un état, un contrôle ou une conséquence plutôt qu'un module entier de stock/qualification.

Exiger avant le code : issue, analyse d'impact, scénario de test et estimation.

## Politique d'incident jeudi

- sélectionner un bug crédible qui peut réellement se produire ;
- si le bug n'existe pas, fournir une reproduction en recette ou un jeu de données qui révèle une lacune ;
- ne jamais demander une correction d'une règle optionnelle non réalisée ;
- faire écrire le test avant ou au moment du correctif ;
- conserver les traces de diagnostic.

## Points de contrôle de l'enseignant

**Lundi soir :** route + BDD + maquette + contrat initial.  
**Mardi soir :** session, rôles et workflow.  
**Mercredi soir :** 3 règles + API.  
**Jeudi soir :** changement + maintenance.  
**Vendredi :** fonctionnalité gelée, livraison et oral blanc.

## Ce qui peut être « fun » sans être gadget

Des données de démo parlantes, des tableaux de bord en temps réel **au rafraîchissement de page**, des refus explicites, des comptes fictifs avec des rôles, un scénario d'incident qui se résout et une maquette soignée. Éviter les animations et services tiers au détriment des tests et de l'authentification.
