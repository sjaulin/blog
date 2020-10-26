<?php

namespace App\src\controller;

class BackController extends Controller
{

    public function addArticle($post)
    {
        if (isset($post['submit'])) {
            if (!empty($_POST['title'])) {
                $this->articleDAO->addArticle($post);
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
