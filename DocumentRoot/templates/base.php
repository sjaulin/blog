<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title><?= $title ?></title>
    <script src="lib/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="content">
        <?= $content ?>
    </div>

    <script>
        var editor = CKEDITOR.replace( 'ckeditor' );
        CKFinder.setupCKEditor( editor );
    </script>
</body>

</html>