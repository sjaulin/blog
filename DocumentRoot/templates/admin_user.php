<?= $this->session->show('alert'); ?>

<h2>Administration des utilisateurs</h2>
<table class="table">
    <tr>
        <td>Id</td>
        <td>Pseudo</td>
        <td>Date</td>
        <td>Rôle</td>
    </tr>
    <?php
    foreach ($users as $user) {
        ?>
        <tr>
            <td><?= $user->getId();?></td>
            <td><?= $user->getPseudo();?></td>
            <td>Créé le : <?= $user->getCreatedDate();?></td>
            <td><?= $user->getRole();?></td>
        </tr>
        <?php
    }
    ?>
</table>