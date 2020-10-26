<?php

namespace App\src\controller;

use App\src\DAO\ArticleDAO;
use App\src\model\View;

class BackController
{
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function addArticle($post)
    {
        if (isset($post['submit'])) {
            if (!empty($_POST['title'])) {
                $articleDAO = new ArticleDAO();
                $articleDAO->addArticle($post);
                header('Location: ../public/index.php');
            } else {
                return $this->view->render('add_article', [
                    'post' => $post,
                    'alert' => 'Erreur dans le formulaire',
                ]);
            }
        }
        return $this->view->render('add_article', [
            'post' => $post
        ]);
    }
}
