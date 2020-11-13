<?= $this->session->show('alert'); ?>
<h2>Commentaires</h2>

<h3>Commentaires à valider</h3>
<table class="table">
    <tr>
        <td>Id</td>
        <td>Article</td>
        <td>Pseudo</td>
        <td>Message</td>
        <td>Date</td>
        <td>Actions</td>
    </tr>
    <?php
    foreach ($unpubliedcomments as $comment) {
        ?>
        <tr>
            <td><?= htmlspecialchars($comment->getId());?></td>
            <td>
                <a href="index.php?route=article&articleId=<?= htmlspecialchars($comment->getArticleId());?>">
                <?= htmlspecialchars($comment->getArticleId());?></a>
            </td>
            <td><?= htmlspecialchars($comment->getPseudo());?></td>
            <td><?= substr(htmlspecialchars($comment->getContent()), 0, 150);?></td>
            <td>Créé le : <?= htmlspecialchars($comment->getCreatedDate());?></td>
            <td>
                <a href="index.php?route=publishComment&commentId=<?= $comment->getId(); ?>">Publier le commentaire</a>
                <a href="index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>">Supprimer le commentaire</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<h3>Commentaires signalés</h3>
<table class="table">
    <tr>
        <td>Id</td>
        <td>Pseudo</td>
        <td>Message</td>
        <td>Date</td>
        <td>Actions</td>
    </tr>
    <?php
    foreach ($flagcomments as $comment) {
        ?>
        <tr>
            <td><?= htmlspecialchars($comment->getId());?></td>
            <td><?= htmlspecialchars($comment->getPseudo());?></td>
            <td><?= substr(htmlspecialchars($comment->getContent()), 0, 150);?></td>
            <td>Créé le : <?= htmlspecialchars($comment->getCreatedDate());?></td>
            <td>
                <a href="/index.php?route=unflagComment&commentId=<?= $comment->getId(); ?>">Désignaler le commentaire</a>
                <a href="../public/index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>">Supprimer le commentaire</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
