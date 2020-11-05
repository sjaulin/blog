<?php
$route = isset($post) && $post->get('id') ? 'editArticle&articleId='.$post->get('id') : 'addArticle';
$submit = $route === 'addArticle' ? 'Envoyer' : 'Mettre à jour';
?>

<form method="post" action="../public/index.php?route=<?= $route; ?>">

<div class="form-group">
    <label for="title">Titre</label>
    <input type="text" id="title" name="title" class="form-control" value="<?= isset($post) ? htmlspecialchars($post->get('title')): ''; ?>">
    <p><?= isset($errors['title']) ? $errors['title'] : ''; ?></p>
</div>

<div class="form-group">
    <label for="title">Introduction</label><br>
    <textarea name="teaser" class="form-control"><?= isset($post) ? htmlspecialchars($post->get('teaser')): ''; ?></textarea>
    <?= isset($errors['teaser']) ? $errors['teaser'] : ''; ?>
</div>

<div class="form-group">
    <label for="content">Contenu</label><br>
    <textarea id="ckeditor" name="content" class="form-control"><?= isset($post) ? htmlspecialchars($post->get('content')): ''; ?></textarea><br>
    <?= isset($errors['content']) ? $errors['content'] : ''; ?>
</div>

    <input type="submit" value="<?= $submit; ?>" id="submit" name="submit">
</form>