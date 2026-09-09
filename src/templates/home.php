<?php declare(strict_types=1); ?>

<section class="hero">
    <p class="eyebrow">Haltung sichtbar machen.</p>

    <h1>
        Ein Badge.<br>
        Eine klare Aussage.
    </h1>

    <p class="intro">
        Frei verwendbare Badges für Websites, soziale Medien,
        Signaturen und Print.
    </p>

    <a href="/#badges" class="button">Badges ansehen</a>
</section>


<section class="badges" id="badges">

    <header class="section-header">
        <p class="eyebrow">Aktuelle Auswahl</p>
        <h2>Zeig Haltung.</h2>
    </header>

    <div class="badge-grid">

        <?php foreach ($badges as $badge): ?>

            <article class="badge-card">

                <div class="badge-preview">
                    <img
                        src="<?= htmlspecialchars($badge['cdnSvg']) ?>"
                        alt="<?= htmlspecialchars($badge['alt']) ?>">
                </div>

                <div class="badge-meta">
                    <div>
                        <span class="badge-style">
                            <?= htmlspecialchars($badge['style']) ?>
                        </span>

                        <h3><?= htmlspecialchars($badge['title']) ?></h3>
                    </div>

                    <span class="version">
                        <?= htmlspecialchars($badge['version']) ?>
                    </span>
                </div>

                <div class="actions">
                    <a href="<?= htmlspecialchars($badge['cdnSvg']) ?>"
                       download>
                        SVG
                    </a>

                    <a href="<?= htmlspecialchars($badge['cdnPng']) ?>"
                       download>
                        PNG
                    </a>

                    <button
                        type="button"
                        data-copy="<?= htmlspecialchars($badge['embed']) ?>">
                        Einbettung kopieren
                    </button>
                </div>

            </article>

        <?php endforeach; ?>

    </div>

</section>


<section class="about" id="about">
    <p class="eyebrow">Grundsatz</p>

    <?= $staticContent['about'] ?>

</section>

<section class="about" id="howto">
    <p class="eyebrow">Benutzung</p>

    <?= $staticContent['howto'] ?>
</section>
