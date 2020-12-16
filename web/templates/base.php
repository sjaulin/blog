<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Blog de Stéphane Jaulin">
    <meta name="author" content="Stéphane Jaulin">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/style.css">

    <link rel="apple-touch-icon" sizes="57x57" href="/public/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/public/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/public/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/public/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/public/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/public/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/public/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/public/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/public/icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/public/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/public/icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/public/icon/favicon-16x16.png">
    <link rel="manifest" href="/public/icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/public/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
 </script>
 
</head>

<body>

<div class="container">
    <div class="py-5 text-center">
        <a href="/index.php"><img class="d-block mx-auto mb-2" src="/public/img/logo-100x100.png" /></a>
        <h1 class="display-4"><a href="/index.php">Mon blog</a></h1>
    </div>
</div>

    <div class="container">
        <div class="row">
            <div class="col-md-9 border">
                <?= $content ?>
            </div>
            <div class="col-md-3 menuside">
                <?= $menucontent ?>

                <h4 class="font-italic">Compte</h4>
                <ul class="nav flex-column">
                <?php if ($this->session->get('pseudo')) { ?>
                        <?php if ($this->session->get('role') === 'admin') { ?>
                            <li class="nav-item"><a class="nav-link" href="/index.php?route=admin_article">Administration</a></li>
                        <?php } ?>
                        <li class="nav-item"><a class="nav-link" href="/index.php?route=profile">Profil</a></li>
                        <li class="nav-item"><a class="nav-link" href="/index.php?route=logout">Déconnexion</a></li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="/index.php?route=register">Inscription</a></li>
                        <li class="nav-item"><a class="nav-link" href="/index.php?route=login">Connexion</a></li>
                    <?php } ?>
                    </ul>
            </div>
        </div>
    </div>

</body>

</html>