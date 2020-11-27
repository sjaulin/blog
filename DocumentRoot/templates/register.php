<div class="py-5 text-center">
    <h2>Inscription</h2>
    <form method="post" action="/index.php?route=register">
        <label for="pseudo">Pseudo *</label><br>
        <input type="text" id="pseudo" name="pseudo" value="<?= isset($post) ? $post->get('pseudo') : ''; ?>"><br>
        <?= isset($errors['pseudo']) ? $errors['pseudo'] : ''; ?>
        <label for="password">Mot de passe *</label><br>
        <input type="password" id="password" name="password"><br>
        <small id="passwordHelpBlock" class="form-text text-muted">
            Le mot de passe doit avoir entre 8 et 20 caractères.
        </small>
        <?= isset($errors['password']) ? $errors['password'] : ''; ?>
        <input type="submit" value="Inscription" id="submit" name="submit">
    </form>
</div>