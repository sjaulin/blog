
<?php $this->title = "Accueil"; // TODO : déplacer dans FrontController ? ?>

<h1>Mon blog</h1>
<p>En construction</p>
<a href="../public/index.php?route=addArticle">Nouvel article</a>
<?php
foreach ($articles as $article) {
    ?>
    <div>
        <h2>
            <a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId()); ?>">
                <?= htmlspecialchars($article->getTitle()); ?>
            </a>
        </h2>
        <p><?= htmlspecialchars($article->getContent()); ?></p>
        <p><?= htmlspecialchars($article->getUserId()); ?></p>
        <p>Créé le : <?= htmlspecialchars($article->getCreatedDate()); ?></p>
    </div>
    <br>
    <?php
}
