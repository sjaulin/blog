<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title><?= $title ?></title>
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>

    <div id="menu">
        <?= $menucontent ?>
    </div>

    <div id="content">
        <?= $content ?>
    </div>

    <script>
        CKEDITOR.replace('ckeditor', {
            filebrowserBrowseUrl: '/public/libraries/php/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: '/public/libraries/php/ckfinder/ckfinder.html?type=Images',
            filebrowserUploadUrl: '/public/libraries/php/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: '/public/libraries/php/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
        });
    </script>
</body>

</html>