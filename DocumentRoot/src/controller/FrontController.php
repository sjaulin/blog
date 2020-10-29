<?php

namespace App\src\controller;

use App\config\Parameter;

class FrontController extends Controller
{

    public function home()
    {
        $articles = $this->articleDAO->getArticles();
        return $this->view->render(
            'home',
            [
                'articles' => $articles,
            ],
        );
    }

    /**
     * Put article to view.
     *
     * @param int $articleId The article Id.
     * @return void
     */
    public function article($articleId)
    {
        $article = $this->articleDAO->getarticle($articleId);
        $comments = $this->commentDAO->getCommentsFromArticle($articleId);
        //TODO Ajouter le titre de la page envoyé au template base ?
        return $this->view->render(
            'single',
            [
                'article' => $article,
                'comments' => $comments,
            ],
        );
    }

    public function addComment(Parameter $post, $articleId)
    {
        if ($post->get('submit')) {
            $this->commentDAO->addComment($post, $articleId);
            $this->session->set('add_comment', 'Le nouveau commentaire a bien été ajouté');
            header('Location: ../public/index.php?route=article&articleId='.$articleId);
        }
    }

    public function flagComment($commentId)
    {
        $this->commentDAO->flagComment($commentId);
        $this->session->set('flag_comment', 'Le commentaire a bien été signalé');
        header('Location: ../public/index.php');
    }
}
