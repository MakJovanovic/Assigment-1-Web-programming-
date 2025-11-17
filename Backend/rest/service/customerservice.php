<?php
require_once __DIR__ . '/../dao/CustomerDao.php';
require_once __DIR__ . "/baseservice.php";

class CustomerService extends BaseService {

    public function __construct() {
        parent::__construct(new CustomerDao());
    }

    public function addCustomer($data) {
        return $this->dao->addCustomer($data);
    }

    public function getCustomerById($id) {
        return $this->dao->getCustomerById($id);
    }

    public function getCustomerByUserId($user_id) {
        return $this->dao->getCustomerByUserId($user_id);
    }

    public function getCustomerByEmail($email) {
        return $this->dao->getCustomerByEmail($email);
    }

    public function getAllCustomers() {
        return $this->dao->getAllCustomers();
    }

    public function updateCustomer($id, $data) {
        if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
        
        if (isset($data['email'])) {
            $existing = $this->dao->getCustomerByEmail($data['email']);
            if ($existing && $existing['id'] != $id) {
                throw new Exception("Email already exists.");
            }
        }
        
        return $this->dao->updateCustomer($id, $data);
    }

    public function deleteCustomer($id) {
        return $this->dao->deleteCustomer($id);
    }

    public function searchCustomersByLastName($last_name) {
        return $this->dao->searchCustomersByLastName($last_name);
    }
}
?>
