<?php

namespace App\src\controller;

use App\config\Parameter;

/**
 * Back controller is use to set instructions of actions (often visitors actions) called by router.
 */
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
                'articles' => $articles,
                'top' => empty($year) && empty($month) ? 1 : 0,
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
                'token' => $this->session->get('token')
            ],
        );
    }

    public function addComment(Parameter $post, $articleId)
    {
        if ($this->checkLoggedIn() && $post->get('submit')) {
            $this->commentDAO->addComment($post, $articleId, $this->session->get('id'));
            $this->session->set('alert', 'Le nouveau commentaire a bien été ajouté');
            header('Location: index.php?route=article&articleId='.$articleId);
        }
    }

    public function flagComment($commentId, $token)
    {
        if ($this->checkLoggedIn() && $this->checkToken($token)) {
            $this->commentDAO->flagComment($commentId);
            $this->session->set('alert', 'Le commentaire a bien été signalé');
            header('Location: index.php');
        }
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
                $this->session->set('alert', 'Votre inscription a bien été effectuée');
                header('Location: index.php');
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
                $this->session->set('alert', 'Content de vous revoir');
                $this->session->set('id', $result['result']['id']);
                $this->session->set('role', $result['result']['name']);
                $this->session->set('pseudo', $post->get('pseudo'));
                $this->session->set('token', md5(time() * rand(128, 731)));
                header('Location: index.php');
            } else {
                $this->session->set('alert', 'Le pseudo ou le mot de passe sont incorrects');
                return $this->view->render('login', [
                    'post'=> $post
                ]);
            }
        }
        return $this->view->render('login');
    }

    public function contact(Parameter $post)
    {
        // The form is submitted.
        if ($post->get('submit')) {
            $errors = $this->validation->validate($post, 'contact');
            // Without error.
            if (!$errors) {
                // Send mail.
                $this->mailer->sendmail(
                    $post->get('mail'),
                    $post->get('name'),
                    CONTACT_TO_MAIL,
                    CONTACT_TO_NAME,
                    'Message posté depuis le blog',
                    $post->get('message')
                );
                $this->session->set('alert', 'Votre message a bien été envoyé !');
                header('Location: index.php');
            }
            // With some errors.
            return $this->view->render('contact', [
                'post' => $post,
                'errors' => $errors
            ]);
        }
        // the form is displayed, set default form values.
        return $this->view->render('contact');
    }
}
