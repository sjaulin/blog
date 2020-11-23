<?= $this->session->show('alert'); ?>
<h2>Administration des articles</h2>
<a href="/index.php?route=addArticle">Nouvel article</a>
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
            <th scope="col">Id</td>
            <th scope="col">Accueil?</td>
            <th scope="col">Titre</td>
            <th scope="col">Auteur</td>
            <th scope="col">Créé le</td>
            <th scope="col">Modifié le</td>
            <th scope="col">Actions</td>
        </tr>
        <?php foreach ($articles as $article) { ?>
            <tr>
                <td scope="row"><?= $article->getId(); ?></td>
                <td scope="row"><?= !empty($article->getTop()) ? 'Oui' : 'Non'; ?></td>
                <td scope="row"><a href="/index.php?route=article&articleId=<?= $article->getId(); ?>">
                        <?= $article->getTitle(); ?>
                    </a></td>
                <td scope="row"><?= $article->getAuthor(); ?></td>
                <td scope="row"><?= $article->getCreatedDate(); ?></td>
                <td scope="row"><?= $article->getUpdatedDate(); ?></td>
                <td scope="row">
                    <a href="/index.php?route=editArticle&articleId=<?= $article->getId(); ?>">Modifier</a>
                    <a href="/index.php?route=deleteArticle&articleId=<?= $article->getId(); ?>&token=<?= $token; ?>">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>