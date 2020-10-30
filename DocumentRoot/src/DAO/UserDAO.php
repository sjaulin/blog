<?php

namespace App\src\DAO;

use App\config\Parameter;

class UserDAO extends DAO
{
    public function register(Parameter $post)
    {
        $sql = 'INSERT INTO user (pseudo, password, create_date) VALUES (?, ?, NOW())';
        $this->createQuery($sql, [$post->get('pseudo'), password_hash($post->get('password'), PASSWORD_BCRYPT)]);
    }

    public function checkUser(Parameter $post)
    {
        $sql = 'SELECT COUNT(pseudo) FROM user WHERE pseudo = ?';
        $result = $this->createQuery($sql, [$post->get('pseudo')]);
        $isUnique = $result->fetchColumn();
        if ($isUnique) {
            return '<p>Le pseudo existe déjà</p>';
        }
    }

    public function login(Parameter $post)
    {
        $sql = 'SELECT id, password FROM user WHERE pseudo = ?';
        $data = $this->createQuery($sql, [$post->get('pseudo')]);
        $result = $data->fetch();
        $isPasswordValid = password_verify($post->get('password'), $result['password']);
        return [
            'result' => $result,
            'isPasswordValid' => $isPasswordValid
        ];
    }
}
