<?= $this->session->show('alert_comment'); ?>
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
    foreach ($unpubliedcomments as $unpubliedcomment) {
        ?>
        <tr>
            <td><?= htmlspecialchars($unpubliedcomment->getId());?></td>
            <td>
                <a href="index.php?route=article&articleId=<?= htmlspecialchars($unpubliedcomment->getArticleId());?>"><?= htmlspecialchars($unpubliedcomment->getArticleId());?></a>
            </td>
            <td><?= htmlspecialchars($unpubliedcomment->getPseudo());?></td>
            <td><?= substr(htmlspecialchars($unpubliedcomment->getContent()), 0, 150);?></td>
            <td>Créé le : <?= htmlspecialchars($unpubliedcomment->getCreatedDate());?></td>
            <td>
                <a href="index.php?route=publishComment&commentId=<?= $unpubliedcomment->getId(); ?>">Publier le commentaire</a>
                <a href="index.php?route=deleteComment&commentId=<?= $unpubliedcomment->getId(); ?>">Supprimer le commentaire</a>
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
    foreach ($flagcomments as $flagcomment) {
        ?>
        <tr>
            <td><?= htmlspecialchars($flagcomment->getId());?></td>
            <td><?= htmlspecialchars($flagcomment->getPseudo());?></td>
            <td><?= substr(htmlspecialchars($flagcomment->getContent()), 0, 150);?></td>
            <td>Créé le : <?= htmlspecialchars($flagcomment->getCreatedDate());?></td>
            <td>
                <a href="../public/index.php?route=unflagComment&commentId=<?= $flagcomment->getId(); ?>">Désignaler le commentaire</a>
                <a href="../public/index.php?route=deleteComment&commentId=<?= $flagcomment->getId(); ?>">Supprimer le commentaire</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
