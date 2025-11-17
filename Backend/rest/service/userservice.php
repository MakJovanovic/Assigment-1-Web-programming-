<?php
require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . "/baseservice.php";

class UserService extends BaseService {

    public function __construct() {
        parent::__construct(new UserDao());
    }

    public function addUser($data) {
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        if ($this->dao->getUserByUsername($data['username'])) {
            throw new Exception("Username already exists.");
        }

        return $this->dao->addUser($data);
    }

    public function getUserById($id) {
        return $this->dao->getUserById($id);
    }

    public function getUserByUsername($username) {
        return $this->dao->getUserByUsername($username);
    }

    public function getAllUsers() {
        return $this->dao->getAllUsers();
    }

    public function updateUser($id, $data) {
        if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        if (isset($data['username'])) {
            $existing = $this->dao->getUserByUsername($data['username']);
            if ($existing && $existing['id'] != $id) {
                throw new Exception("Username already exists.");
            }
        }

        return $this->dao->updateUser($id, $data);
    }

    public function deleteUser($id) {
        return $this->dao->deleteUser($id);
    }
}
?>
