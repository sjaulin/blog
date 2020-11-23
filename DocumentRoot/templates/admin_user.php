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
            <td><?= htmlspecialchars($user->getId());?></td>
            <td><?= htmlspecialchars($user->getPseudo());?></td>
            <td>Créé le : <?= htmlspecialchars($user->getCreatedDate());?></td>
            <td><?= htmlspecialchars($user->getRole());?></td>
        </tr>
        <?php
    }
    ?>
</table>