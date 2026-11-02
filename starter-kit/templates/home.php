<?php
/** @var array $equipment */
/** @var ?string $error */
/** @var string $csrf */
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Starter Slim + Medoo</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 960px; margin: 2rem auto; padding: 0 1rem; line-height: 1.5; }
        nav { display: flex; gap: 1rem; margin-bottom: 2rem; }
        form { display: grid; gap: .75rem; max-width: 420px; padding: 1rem; border: 1px solid #ccc; border-radius: .5rem; }
        input, select, button { padding: .65rem; font: inherit; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border-bottom: 1px solid #ddd; padding: .65rem; text-align: left; }
        .error { padding: .75rem; border: 1px solid currentColor; }
        code { background: #f2f2f2; padding: .15rem .35rem; }
    </style>
</head>
<body>
<nav>
    <a href="/">Accueil</a>
    <a href="/api/health">API health</a>
    <a href="/api/equipment">API equipment</a>
</nav>

<h1>Starter Slim + Medoo</h1>

<p>
    Cette page illustre une vue HTML alimentée par
    <code>Route → Controller → Service → Repository → Medoo</code>.
</p>
<p><strong>Exemple de formation :</strong> aucune authentification n'est implémentée.
    N'exposez pas le POST public de cette démonstration sur Internet.</p>

<?php if ($error !== null): ?>
    <p class="error" role="alert">
        <?= htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
    </p>
<?php endif; ?>

<h2>Ajouter un équipement</h2>

<form method="post" action="/equipment">
    <input type="hidden" name="csrf"
           value="<?= htmlspecialchars($csrf, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">

    <label>
        Nom
        <input name="name" required maxlength="150">
    </label>

    <label>
        Statut
        <select name="status">
            <option value="AVAILABLE">Disponible</option>
            <option value="MAINTENANCE">Maintenance</option>
            <option value="UNAVAILABLE">Indisponible</option>
        </select>
    </label>

    <button type="submit">Créer</button>
</form>

<h2>Équipements</h2>

<table>
    <thead><tr><th>ID</th><th>Nom</th><th>Statut</th><th>Créé le</th></tr></thead>
    <tbody>
    <?php foreach ($equipment as $item): ?>
        <tr>
            <td><?= (int) $item['id'] ?></td>
            <td><?= htmlspecialchars((string) $item['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></td>
            <td><?= htmlspecialchars((string) $item['status'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></td>
            <td><?= htmlspecialchars((string) $item['created_at'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
