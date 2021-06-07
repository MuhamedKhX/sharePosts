<?php


class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPosts()
    {
        $this->db->query("SELECT * FROM shareposts.posts ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    public function getPostById($id)
    {
        $this->db->query("SELECT * FROM shareposts.posts WHERE id = :id");

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        if($this->db->rowCount() > 0)
        {
            return $row;
        } else
        {
            return false;
        }
    }

    public function editPost($data)
    {
        $this->db->query('UPDATE shareposts.posts SET title= :title, body= :body WHERE id=' . $data['id']);

        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['description']);

        if($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function createPost($data)
    {
        $this->db->query('INSERT INTO shareposts.posts (title, body, user_id) VALUES (:title, :body, :user_id) ');

        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['description']);
        $this->db->bind(':user_id', $data['user_id']);

        if($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}


//Storn [10/10]