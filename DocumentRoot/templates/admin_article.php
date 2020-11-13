<?= $this->session->show('alert'); ?>
<h2>Articles</h2>
<a href="/index.php?route=addArticle">Nouvel article</a>
<table class="table">
    <tr>
        <td>Id</td>
        <td>Page d'accueil ?</td>
        <td>Titre</td>
        <td>Auteur</td>
        <td>Créé le</td>
        <td>Modifié le</td>
        <td>Actions</td>
    </tr>
    <?php foreach ($articles as $article) { ?>
        <tr>
            <td><?= htmlspecialchars($article->getId()); ?></td>
            <td><?= !empty($article->getTop()) ? 'Oui' : 'Non'; ?></td>
            <td><a href="/index.php?route=article&articleId=<?= htmlspecialchars($article->getId()); ?>">
                    <?= htmlspecialchars($article->getTitle()); ?>
                </a></td>
            <td><?= htmlspecialchars($article->getAuthor()); ?></td>
            <td><?= htmlspecialchars($article->getCreatedDate()); ?></td>
            <td><?= htmlspecialchars($article->getUpdatedDate()); ?></td>
            <td>
                <a href="/index.php?route=editArticle&articleId=<?= $article->getId(); ?>">Modifier</a>
                <a href="/index.php?route=deleteArticle&articleId=<?= $article->getId(); ?>">Supprimer</a>
            </td>
        </tr>
    <?php } ?>
</table>