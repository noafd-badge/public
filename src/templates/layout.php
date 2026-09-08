<?php declare(strict_types=1); ?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title><?= htmlspecialchars($title) ?></title>

    <link rel="stylesheet" href="/assets/css/main.css">
    <script src="/assets/js/main.js" defer></script>
</head>

<body>

<header class="site-header">
    <a class="brand" href="/">NoAfD Badge</a>

    <nav>
<?php if ($isHome): ?>
        <a href="/#badges">Badges</a>
        <a href="/#about">Über das Projekt</a>
        <a href="/#howto">Benutzung</a>
<?php else: ?>
        <a href="/#badges">Badges</a>
        <a href="/projekt">Über das Projekt</a>
        <a href="/platzhalter">Platzhalter</a>
<?php endif; ?>
    </nav>

</header>

<main>
    <?= $content ?>
</main>

<footer class="site-footer">
    <span>Unabhängige Initiative. Kein Tracking. Keine Cookies.</span>
    <span>
        <a href="/impressum">Impressum</a>
        .
        <a href="/datenschutz">Datenschutz</a>

    </span>
</footer>

</body>
</html>