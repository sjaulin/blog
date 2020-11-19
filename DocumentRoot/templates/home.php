<?= $this->session->show('alert'); ?>

<?php
foreach ($articles as $article) {
    ?>
    <div>
        <h2>
            <?php if (!empty($top)) { ?>
                <?= htmlspecialchars($article->getTitle()); ?>
            <?php } else { ?>
                <a href="/index.php?route=article&articleId=<?= htmlspecialchars($article->getId()); ?>">
                <?= htmlspecialchars($article->getTitle()); ?>
            </a>
            <?php } ?>
        </h2>
        <p>Le : <?= htmlspecialchars($article->getCreatedDate()); ?></p>
        <h3><?= htmlspecialchars($article->getTeaser()); ?></h3>
        <?php if (!empty($top)) { ?>
        <p><?= $article->getContent(); ?></p>
        <?php } ?>
        <p><?= htmlspecialchars($article->getAuthor()); ?></p>
    </div>
    <?php
}
