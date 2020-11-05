<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title><?= $title ?></title>
    <script src="libraries/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="libraries/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="menu">
        <?= $menu ?>
    </div>
    <div id="content">
        <?= $content ?>
    </div>

    <script>
    CKEDITOR.replace( 'ckeditor',
    {
        filebrowserBrowseUrl: '/public/libraries/php/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '/public/libraries/php/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: '/public/libraries/php/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '/public/libraries/php/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    });
    </script>
</body>

</html>