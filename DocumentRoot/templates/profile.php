<?= $this->session->show('alert'); ?>
<h2>Votre profil</h2>
<div class="py-5 text-center">
    <h1><i class="fa fa-user-circle-o fa-5" aria-hidden="true"></i></h1>
    <h3><?= $this->session->get('pseudo'); ?> #<?= $this->session->get('id'); ?></h3>
    <div><a href="/index.php?route=updatePassword">Modifier son mot de passe</a></div>
</div>