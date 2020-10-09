<?php
use App\src\DAO\PostDAO;
?>
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
        $post = new PostDAO();
        $posts = $post->getPosts();
        while ($post = $posts->fetch()) {
            ?>
        <div>
            <h2><a href="../public/index.php?route=post&postId=<?= htmlspecialchars($post->id);?>"><?= htmlspecialchars($post->title);?></a></h2>
            <p><?= htmlspecialchars($post->content);?></p>
            <p><?= htmlspecialchars($post->user_id);?></p>
            <p>Créé le : <?= htmlspecialchars($post->create_date);?></p>
        </div>
        <br>
            <?php
        }
        $posts->closeCursor();
        ?>
    </div>
</body>
</html>