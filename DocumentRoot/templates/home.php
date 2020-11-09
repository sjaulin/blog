
<?php $this->title = "Accueil"; // TODO : déplacer dans FrontController ? ?>

<h1>Mon blog</h1>
<p>En construction</p>
<?php // TODO Déplacer dans base.php (pas réussi pb de double chargement de base.php) ?>
<?= $this->session->show('add_comment'); ?>
<?= $this->session->show('flag_comment'); ?>
<?= $this->session->show('delete_comment'); ?>
<?= $this->session->show('register'); ?>
<?= $this->session->show('login'); ?>
<?= $this->session->show('logout'); ?>
<?= $this->session->show('delete_account'); ?>
<?php
if ($this->session->get('pseudo')) { ?>
    <a href="../public/index.php?route=logout">Déconnexion</a>
    <a href="../public/index.php?route=profile">Profil</a>
    <?php if ($this->session->get('role') === 'admin') { ?>
        <a href="../public/index.php?route=admin_article">Administration</a>
    <?php } ?>
<?php } else { ?>
    <a href="../public/index.php?route=register">Inscription</a>
    <a href="../public/index.php?route=login">Connexion</a>
<?php } ?>

<?php
foreach ($articles as $article) {
    ?>
    <div>
        <h2>
            <a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId()); ?>">
                <?= htmlspecialchars($article->getTitle()); ?>
            </a>
        </h2>
        <h3><?= htmlspecialchars($article->getTeaser()); ?></h3>
        <p><?= $article->getContent(); // TODO Limit substr...?></p>
        <p><?= htmlspecialchars($article->getAuthor()); ?></p>
        <p>Créé le : <?= htmlspecialchars($article->getCreatedDate()); ?></p>
    </div>
    <br>
    <?php
}
