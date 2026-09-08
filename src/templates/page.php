<?php declare(strict_types=1); ?>

<article class="page">

    <header class="page-header">
        <h1><?= htmlspecialchars($page['title']) ?></h1>
    </header>

    <div class="page-content">
        <?= $page['html'] ?>
    </div>

</article>