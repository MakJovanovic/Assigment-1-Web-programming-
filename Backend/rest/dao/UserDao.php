<?php
require_once __DIR__ . "/BaseDao.php";

class UserDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("users"); 
    }

    public function getAllUsers()
    {
        return $this->query("SELECT * FROM users", []);
    }

    public function getUserById($id)
    {
        return $this->query_unique("SELECT * FROM users WHERE id = :id", ["id" => $id]);
    }

    public function getUserByUsername($username)
    {
        return $this->query_unique("SELECT * FROM users WHERE username = :username", ["username" => $username]);
    }

    public function addUser($user)
    {
        return $this->add($user);
    }

    public function updateUser($id, $user)
    {
        return $this->update($user, $id);
    }

    public function deleteUser($id)
    {
        return $this->delete($id);
    }
}
?>
