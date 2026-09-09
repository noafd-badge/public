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

    <nav class="main-nav" aria-label="Hauptnavigation">
        <?php $renderNavigation($mainNavigation); ?>
    </nav>

</header>

<main>
    <?= $content ?>
</main>

<footer class="site-footer">
    <span>Unabhängige Initiative. Kein Tracking. Keine Cookies.</span>
    <span>
        <nav class="footernav" aria-label="Footernavigation">
        <?php $renderNavigation($footerNavigation); ?>
        </nav>
    </span>
</footer>

</body>
</html>