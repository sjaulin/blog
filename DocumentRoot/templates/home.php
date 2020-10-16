
<?php $this->title = "Accueil"; // TODO : déplacer dans FrontController ? ?>

<h1>Mon blog</h1>
<p>En construction</p>

<?php
foreach ($posts as $post) {
    ?>
    <div>
        <h2>
            <a href="../public/index.php?route=post&postId=<?= htmlspecialchars($post->getId()); ?>">
                <?= htmlspecialchars($post->getTitle()); ?>
            </a>
        </h2>
        <p><?= htmlspecialchars($post->getContent()); ?></p>
        <p><?= htmlspecialchars($post->getUserId()); ?></p>
        <p>Créé le : <?= htmlspecialchars($post->getCreatedDate()); ?></p>
    </div>
    <br>
    <?php
}
