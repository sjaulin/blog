<?= $this->session->show('alert'); ?>

<?php
foreach ($articles as $article) {
    ?>
    <div>
        <h2>
            <?php if (!empty($top)) { ?>
                <?= $article->getTitle(); ?>
            <?php } else { ?>
                <a href="/index.php?route=article&articleId=<?= $article->getId(); ?>">
                <?= $article->getTitle(); ?>
            </a>
            <?php } ?>
        </h2>
        <p>Le : <?= $article->getCreatedDate(); ?></p>
        <h3><?= $article->getTeaser(); ?></h3>
        <?php if (!empty($top)) { ?>
        <p><?= $article->getContent(); ?></p>
        <?php } ?>
        <p><?= $article->getAuthor(); ?></p>
    </div>
    <?php
}
