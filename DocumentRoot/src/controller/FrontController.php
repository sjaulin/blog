<?php

namespace App\src\controller;

use App\config\Parameter;

class FrontController extends Controller
{

    public function home($year = null, $month = null)
    {
        $articles = $this->articleDAO->getArticles($year, $month, null);
        $menu = $this->articleDAO->getArticlesMenu();
        return $this->view->render(
            'home',
            [
                'menu' => $menu,
                'articles' => $articles
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
        $menu = $this->articleDAO->getArticlesMenu();
        return $this->view->render(
            'single',
            [
                'menu' => $menu,
                'article' => $article,
                'comments' => $comments,
            ],
        );
    }

    public function addComment(Parameter $post, $articleId)
    {
        if ($post->get('submit')) {
            $this->commentDAO->addComment($post, $articleId, $this->session->get('id'));
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

    public function register(Parameter $post)
    {
        if ($post->get('submit')) {
            $errors = $this->validation->validate($post, 'User');
            if ($this->userDAO->checkUser($post)) {
                $errors['pseudo'] = $this->userDAO->checkUser($post);
            }
            if (!$errors) {
                $this->userDAO->register($post);
                $this->session->set('register', 'Votre inscription a bien été effectuée');
                header('Location: ../public/index.php');
            }
            return $this->view->render('register', [
                'post' => $post,
                'errors' => $errors
            ]);
        }
        return $this->view->render('register');
    }

    public function login(Parameter $post)
    {
        if ($post->get('submit')) {
            $result = $this->userDAO->login($post);
            if ($result && $result['isPasswordValid']) {
                $this->session->set('login', 'Content de vous revoir');
                $this->session->set('id', $result['result']['id']);
                $this->session->set('role', $result['result']['name']);
                $this->session->set('pseudo', $post->get('pseudo'));
                header('Location: ../public/index.php');
            } else {
                $this->session->set('error_login', 'Le pseudo ou le mot de passe sont incorrects');
                return $this->view->render('login', [
                    'post'=> $post
                ]);
            }
        }
        return $this->view->render('login');
    }
}
