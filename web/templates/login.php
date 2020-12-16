<?= $this->session->show('alert'); ?>

<div class="py-5 text-center">
    <h2>Connexion</h2>
    <form method="post" action="../index.php?route=login">
        <label for="pseudo">Pseudo *</label><br>
        <input type="text" id="pseudo" name="pseudo"><br>
        <label for="password">Mot de passe *</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Connexion" id="submit" name="submit">
    </form>
</div>