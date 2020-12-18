<form id="demo-form" method="post" action="/index.php?route=addComment&articleId=<?= $article->getId(); ?>">
    <label for="content">Message</label><br>
    <textarea id="content" name="content"></textarea><br>
    <?= $this->session->show('alert_message'); ?>
    <input type="submit" value="Ajouter" id="submit" name="submit">
</form>

