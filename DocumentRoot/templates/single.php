<?= $this->session->show('alert'); ?>
<div>
    <h2><?= $article->getTitle(); ?></h2>
    <p><i class="fa fa-clock-o" aria-hidden="true"></i> <?= $article->getCreatedDate(); ?></p>
    <?php if ($this->session->get('pseudo') && $this->session->get('role') === 'admin') { ?>
        <div class="actions">
            <a href="/index.php?route=editArticle&articleId=<?= $article->getId(); ?>">Modifier</a> -
            <a href="/index.php?route=deleteArticle&articleId=<?= $article->getId(); ?>">Supprimer</a>
        </div>
    <?php } ?>

    <p><i class="fa fa-user-circle-o fa-5" aria-hidden="true"></i> <?= $article->getAuthor(); ?></p>
    <h3><?= $article->getTeaser(); ?></h3>
    <p><?= $article->getContent(); ?></p>
    <p>Mis à jour le <?= $article->getUpdatedDate(); ?></p>
</div>


<div id="comments">
    <?php if ($this->session->get('pseudo')) { ?>
        <h3>Ajouter un commentaire</h3>
        <?php include('form_comment.php'); ?>
    <?php } ?>

    <?php if (!empty($comments)) { ?>
        <h3>Commentaires</h3>
        <?php foreach ($comments as $comment) { ?>
            <h4><?= $comment->getPseudo(); ?></h4>
            <p><?= $comment->getContent(); ?></p>
            <p>Créé le <?= $comment->getCreatedDate(); ?></p>
            <?php if ($this->session->get('pseudo') && $comment->isFlag()) { ?>
                <p>Ce commentaire a déjà été signalé</p>
            <?php } elseif ($this->session->get('pseudo')) { ?>
                <p><a href="/index.php?route=flagComment&commentId=<?= $comment->getId(); ?>">Signaler le commentaire</a></p>
            <?php } ?>

            <?php if ($this->session->get('pseudo') && $this->session->get('role') === 'admin') { ?>
                <p><a href="/index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>">Supprimer le commentaire</a></p>
            <?php } ?>
            <br>
        <?php } ?>
    <?php } ?>
</div>