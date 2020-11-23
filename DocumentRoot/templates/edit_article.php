<h2>Modifier l'article</h2>
<div>
    <?php include('form_article.php');?>
</div>
<script>
        CKEDITOR.replace('ckeditor', {
            filebrowserBrowseUrl: '/public/libraries/php/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: '/public/libraries/php/ckfinder/ckfinder.html?type=Images',
            filebrowserUploadUrl: '/public/libraries/php/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: '/public/libraries/php/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
        });
    </script>