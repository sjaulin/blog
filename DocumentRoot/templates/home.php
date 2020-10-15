<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Mon blog</title>
</head>

<body>
    <div>
        <h1>Mon blog</h1>
        <p>En construction</p>
        <?php
        foreach ($posts as $post) {
            ?>
        <div>
            <h2>
                <a href="../public/index.php?route=post&postId=<?= htmlspecialchars($post->getId());?>">
                <?= htmlspecialchars($post->getTitle());?>
                </a>
            </h2>
            <p><?= htmlspecialchars($post->getContent());?></p>
            <p><?= htmlspecialchars($post->getUserId());?></p>
            <p>Créé le : <?= htmlspecialchars($post->getCreatedDate());?></p>
        </div>
        <br>
            <?php
        }
        ?>
    </div>
</body>
</html>