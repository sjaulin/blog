<?php

namespace App\src\controller;

use App\config\Parameter;

/**
 * Back controller is use to set instructions of actions (often admin actions) called by router.
 */
class BackController extends Controller
{
    public static $menu = array(
        'admin_article' => array('title' => 'Administrer les articles'),
        'admin_comment' => array('title' => 'Administrer les commentaires'),
        'admin_user' => array('title' => 'Administrer les utilisateurs')
    );

    private function checkAdmin()
    {
        $this->checkLoggedIn();
        if (!($this->session->get('role') === 'admin')) {
            $this->session->set('alert', 'Vous n\'avez pas le droit d\'accéder à cette page');
            header('Location: index.php?route=profile');
        } else {
            return true;
        }
    }

    public function adminArticle()
    {
        if ($this->checkAdmin()) {
            $articles = $this->articleDAO->getArticles(null, null, 1);
            return $this->view->renderAdmin('admin_article', [
                'menu' => self::$menu,
                'articles' => $articles,
                'token' => $this->session->get('token')
            ]);
        }
    }

    public function adminComment()
    {
        if ($this->checkAdmin()) {
            $unpubliedcomments = $this->commentDAO->getUnpublishedComments();
            $flagcomments = $this->commentDAO->getFlagComments();
            return $this->view->renderAdmin('admin_comment', [
                'menu' => self::$menu,
                'unpubliedcomments' => $unpubliedcomments,
                'flagcomments' => $flagcomments,
                'token' => $this->session->get('token')
            ]);
        }
    }

    public function adminUser()
    {
        if ($this->checkAdmin()) {
            $users = $this->userDAO->getUsers();
            return $this->view->renderAdmin('admin_user', [
                'menu' => self::$menu,
                'users' => $users,
                'token' => $this->session->get('token')
            ]);
        }
    }

    public function addArticle(Parameter $post)
    {
        if ($this->checkAdmin()) {
            // The form is submitted.
            if ($post->get('submit')) {
                // Without error.
                $errors = $this->validation->validate($post, 'Article');
                if (!$errors) {
                    $this->articleDAO->addArticle($post, $this->session->get('id'));
                    $this->session->set('alert', 'Le nouvel article a bien été ajouté');
                    header('Location: index.php?route=admin_article');
                }
                // With some errors.
                return $this->view->renderAdmin('add_article', [
                    'post' => $post,
                    'errors' => $errors
                ]);
            }

            // the form is displayed.
            return $this->view->renderAdmin('add_article');
        }
    }

    public function editArticle(Parameter $post, $articleId)
    {
        if ($this->checkAdmin()) {
            $article = $this->articleDAO->getArticle($articleId);
            // The form is submitted.
            if ($post->get('submit')) {
                $errors = $this->validation->validate($post, 'Article');
                // Without error.
                if (!$errors) {
                    $this->articleDAO->editArticle($post, $articleId, $this->session->get('id'));
                    $this->session->set('alert', 'L\' article a bien été modifié');
                    header('Location: index.php?route=admin_article');
                    die;
                }
                // With some errors.
                header('Location: index.php?route=editArticle&articleid=' . $articleId);
                die;
            }

            // the form is displayed, set default form values.
            $post->set('id', $article->getId());
            $post->set('title', $article->getTitle());
            $post->set('teaser', $article->getTeaser());
            $post->set('content', $article->getContent());
            $post->set('author', $article->getAuthor());
            $post->set('top', $article->getTop());

            return $this->view->renderAdmin('edit_article', [
                'menu' => self::$menu,
                'post' => $post
            ]);
        }
    }

    public function deleteArticle($articleId, $token)
    {
        if ($this->checkAdmin() && $this->checkToken($token)) {
            $this->articleDAO->deleteArticle($articleId);
            $this->session->set('alert', 'L\' article a bien été supprimé');
            header('Location: index.php?route=admin_article');
        }
    }

    public function publishComment($commentId, $token)
    {
        if ($this->checkAdmin() && $this->checkToken($token)) {
            $this->commentDAO->publishComment($commentId);
            $this->session->set('alert', 'Le commentaire a bien été publié');
            header('Location: index.php?route=admin_comment');
        }
    }

    public function unflagComment($commentId, $token)
    {
        if ($this->checkAdmin() && $this->checkToken($token)) {
            $this->commentDAO->unflagComment($commentId);
            $this->session->set('alert', 'Le commentaire a bien été désignalé');
            header('Location: index.php?route=admin_comment');
        }
    }

    public function deleteComment($commentId, $token)
    {
        if ($this->checkAdmin() && $this->checkToken($token)) {
            $this->commentDAO->deleteComment($commentId);
            $this->session->set('alert', 'Le commentaire a bien été supprimé');
            header('Location: index.php?route=admin_comment');
        }
    }

    public function profile()
    {
        if ($this->checkLoggedIn()) {
            return $this->view->render('profile');
        }
    }

    public function updatePassword(Parameter $post)
    {
        if ($this->checkLoggedIn()) {
            if ($post->get('submit')) {
                $this->userDAO->updatePassword($post, $this->session->get('pseudo'));
                $this->session->set('alert', 'Le mot de passe a été mis à jour');
                header('Location: index.php?route=profile');
            }
            return $this->view->render('update_password');
        }
    }

    public function logout()
    {
        if ($this->checkLoggedIn()) {
            $this->session->stop();
            $this->session->start();
            $this->session->set('alert', 'À bientôt');
            header('Location: index.php');
        }
    }

    public function deleteAccount()
    {
        if ($this->checkLoggedIn()) {
            $this->userDAO->deleteAccount($this->session->get('pseudo'));
            $this->session->stop();
            $this->session->start();
            $this->session->set('alert', 'Votre compte a bien été supprimé');
            header('Location: index.php');
        }
    }

    public function deleteUser($userId)
    {
        if ($this->checkAdmin()) {
            $this->userDAO->deleteUser($userId);
            $this->session->set('alert', 'L\'utilisateur a bien été supprimé');
            header('Location: index.php?route=admin_user');
        }
    }
}
