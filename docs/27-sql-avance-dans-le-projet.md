# 27 — Vues, procédures stockées et triggers dans le projet

**Clause obligatoire commune à Backstage, RepairLab et EscapeOps.** Ces mécanismes appartiennent au socle technique, **sans remplacer les trois règles contractuelles choisies**.

## Minimum attendu

1. **Au moins un trigger pertinent**, BEFORE ou AFTER INSERT/UPDATE/DELETE : journalisation d'un changement métier, contrôle d'une transition ou autre automatisation justifiée. Il doit réellement se déclencher depuis une action de l'application. Prouvez son effet avec un test.
2. **Au moins une procédure stockée**, avec paramètres adaptés, **appelée depuis un repository PHP** et dont le résultat ou l'effet sert véritablement le site ou l'API. Vous pouvez en créer davantage. Faire tous les accès aux données exclusivement par procédures est facultatif, **pas une obligation**.
3. **Au moins deux vues SQL intelligentes**, consommées **toutes deux depuis le code** : listes avec jointures, reporting, statistiques, synthèses, consultation simplifiée, etc. Une vue inutilisée ou une simple duplication de SELECT * ne suffit pas.
4. **Objets SQL versionnés dans Git** et reconstruisibles depuis une base vierge : scripts ordonnés ou migrations, jeu de test et ordre d'application expliqués dans le README. Une procédure ou un trigger créé seulement à la main dans Adminer ne constitue pas un livrable.

Ces objets doivent répondre aux **besoins du métier** et peuvent directement servir les trois règles contractuelles, le tableau de bord ou la traçabilité déjà exigés. **N'ajoutez pas trois fonctionnalités artificielles.**

## Exemples non imposés, par univers

| Sujet | Trigger possible | Procédure possible | Vues possibles |
|---|---|---|---|
| Backstage | Historiser un changement d'état d'une activité | Bilan des affectations d'un événement | Programme publié ; état d'affectation et des incidents |
| RepairLab | Historiser le passage en maintenance d'une machine | Bilan des interventions d'un équipement | Équipements disponibles ; synthèse des incidents |
| EscapeOps | Historiser les transitions de session | Bilan d'exploitation par salle | Planning détaillé ; tableau de bord incidents/sessions |

## Lien avec Slim 4 et Medoo

**Slim 4** assure l'interface HTTP, pas les migrations ; **Medoo** est construit sur PDO. Un repository peut continuer d'utiliser Medoo pour les opérations simples, interroger une vue comme une table et employer PDO pour une procédure stockée. Références : https://medoo.in/api/pdo et https://medoo.in/api/query.

```php
// Extrait illustratif : la procédure est à créer dans votre base.
public function bilan(int $id): array
{
    $stmt = $this->database->pdo->prepare(
        'CALL sp_bilan_ressource(:id)'
    );
    $stmt->execute(['id' => $id]);

    try {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } finally {
        $stmt->closeCursor();
    }
}
```

Cet exemple suppose un repository possédant une propriété Medoo nommée database. **L'existence et la signature de sp_bilan_ressource sont à définir par l'étudiant.** Conservez les contrôles métier et les droits dans les services/contrôleurs adaptés : ni la vue ni le trigger ne remplacent l'autorisation serveur. Pas de SQL dans les templates HTML.

## Versionnement : solution simple et suffisante

Le starter et Slim 4 **ne fournissent pas un système de migration natif**. La solution recommandée pour une semaine est d'enregistrer des scripts SQL numérotés :

```text
database/
  migrations/
    001_schema.sql
    002_vues.sql
    003_procedures.sql
    004_triggers.sql
  seed.sql
README.md   (ordre d'application et restauration)
```

Les noms sont libres : l'important est de conserver **dans Git** tous les objets et de décrire les commandes pour les appliquer dans l'ordre à une **base vierge**, ainsi que les modifications futures. Un dossier nommé migrations n'est **pas** un mécanisme automatique en soi. Documentez le moteur choisi (MySQL ou MariaDB), l'outil d'import et les versions.

**Attention à DELIMITER :** ce n'est pas une commande SQL du serveur, mais du client mysql. Elle sert aux scripts multi-instructions importés via ce client ; **ne transmettez pas DELIMITER tel quel à PDO**. Pour une migration PHP/PDO, envoyez la déclaration CREATE PROCEDURE ou CREATE TRIGGER comme une requête complète. Testez la reconstruction réelle sur une base de test séparée.

Option avancée, **non obligatoire** : intégrer Phinx (https://phinx.org/docs/) ; cet outil indépendant permet des migrations SQL/PHP. Il ne faut pas développer un moteur de migrations maison pour réussir ce projet.

## Preuves et critères de réussite

- Pour **chaque vue** : définition SQL, exemple de résultat, extrait de repository PHP et page ou réponse JSON qui en dépend.
- Pour la **procédure** : CREATE PROCEDURE, CALL SQL, appel PHP paramétré dans le repository et effet ou résultat visible.
- Pour le **trigger** : CREATE TRIGGER, opération qui le déclenche, résultat avant/après, plus un cas où la condition est fausse ou où une modification est refusée.
- Pour le **versionnement** : fichiers Git, installation reproductible sur base neuve, jeu d'essai et preuve du déroulement.

**Périmètre pédagogique :** les vues, procédures et triggers illustrent notamment les compétences « exploiter des données à l'aide d'un langage de requêtes » et « développer des fonctionnalités applicatives au sein d'un SGBD » du BTS SIO SLAM. Ces quotas **ne sont pas imposés par le référentiel national** : ils constituent la clause spécifique de votre projet de semaine.

*Voir aussi : [cadre technique](01-cadre-technique.md), [tests](26-tests-et-demonstration.md), [checklist](13-checklist.md).*
