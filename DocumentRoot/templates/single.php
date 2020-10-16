<?php $this->title = "Post"; // TODO : déplacer dans FrontController ??>
<h1>Mon blog</h1>
<p>En construction</p>
<div>
    <h2><?= htmlspecialchars($post->getTitle()); ?></h2>
    <p><?= htmlspecialchars($post->getContent()); ?></p>
    <p>Créé le : <?= htmlspecialchars($post->getCreatedDate()); ?></p>
</div>
<br>
<a href="../public/index.php">Retour à l'accueil</a>

<div id="comments" class="text-left" style="margin-left: 50px">
    <h3>Commentaires</h3>
    <?php
    foreach ($comments as $comment) {
        ?>
        <h4><?= htmlspecialchars($comment->getUserId()); ?></h4>
        <p><?= htmlspecialchars($comment->getContent()); ?></p>
        <p>Posté le <?= htmlspecialchars($comment->getCreatedDate()); ?></p><?php
    }
    ?>
</div>
</div>