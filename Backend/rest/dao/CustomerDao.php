<?php
require_once __DIR__ . "/BaseDao.php";

class CustomerDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("customers");
    }

    public function getAllCustomers()
    {
        return $this->query("SELECT * FROM customers", []);
    }

    public function getCustomerById($id)
    {
        return $this->query_unique("SELECT * FROM customers WHERE id = :id", ["id" => $id]);
    }

    public function getCustomerByUserId($user_id)
    {
        return $this->query_unique("SELECT * FROM customers WHERE user_id = :user_id", ["user_id" => $user_id]);
    }

    public function getCustomerByEmail($email)
    {
        return $this->query_unique("SELECT * FROM customers WHERE email = :email", ["email" => $email]);
    }

    public function addCustomer($customer)
    {
        return $this->add($customer);
    }

    public function updateCustomer($id, $customer)
    {
        return $this->update($customer, $id);
    }

    public function deleteCustomer($id)
    {
        return $this->delete($id);
    }



    public function searchCustomersByLastName($last_name)
    {
        return $this->query(
            "SELECT * FROM customers WHERE last_name LIKE :last_name",
            ["last_name" => "%" . $last_name . "%"]
        );
    }
}
?>
