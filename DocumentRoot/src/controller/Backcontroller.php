<?php

namespace App\src\controller;

use App\config\Parameter;

class BackController extends Controller
{

    public function addArticle(Parameter $post)
    {
        if ($post->get('submit')) {
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
