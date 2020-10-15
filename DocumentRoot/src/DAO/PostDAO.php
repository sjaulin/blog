<?php

/**
 * Post Data Access Object.
 */

namespace App\src\DAO;

use App\src\model\Post;

class PostDAO extends DAO
{
    // Convert database cols to object properties.
    private function buildObject($row)
    {
        $post = new Post();
        $post->setId($row['id']);
        $post->setTitle($row['title']);
        $post->setContent($row['content']);
        $post->setUserId($row['user_id']);
        $post->setCreatedDate($row['create_date']);
        $post->setUpdatedDate($row['update_date']);
        return $post;
    }

    public function getPosts()
    {
        $sql = 'SELECT id, title, content, user_id, create_date, update_date FROM post ORDER BY id DESC';
        $result = $this->createQuery($sql);
        $posts = [];
        foreach ($result as $row) {
            $postId = $row['id'];
            $posts[$postId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $posts;
    }

    /**
     * Get Object post by post ID
     *
     * @param int $postId
     * @return object The Post Object.
     */
    public function getPost($postId)
    {
        $sql = 'SELECT id, title, content, user_id, create_date FROM post WHERE id = ?';
        $result = $this->createQuery($sql, [$postId]);
        $post = $result->fetch();
        $result->closeCursor();
        return $this->buildObject($post);
    }
}
