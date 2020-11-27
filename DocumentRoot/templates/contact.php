<h2>Contactez-moi</h2>
<form method="post" action="/index.php?route=contact">
    <div class="form-group">
        <label for="name">Votre prénom et nom *</label>
        <input type="text" id="name" name="name" class="form-control" value="<?= isset($post) ? $post->get('name') : ''; ?>">
        <p><?= isset($errors['name']) ? $errors['name'] : ''; ?></p>
    </div>

    <div class="form-group">
        <label for="mail">Votre email *</label>
        <input type="text" id="mail" name="mail" class="form-control" value="<?= isset($post) ? $post->get('mail') : ''; ?>">
        <p><?= isset($errors['mail']) ? $errors['mail'] : ''; ?></p>
    </div>

    <div class="form-group">
        <label for="message">Votre message *</label><br>
        <textarea name="message" class="form-control"></textarea><br>
        <?= isset($errors['message']) ? $errors['message'] : ''; ?>
    </div>

    <input type="submit" value="Envoyer" id="submit" name="submit">
</form>