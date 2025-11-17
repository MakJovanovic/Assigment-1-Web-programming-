<?php
require_once __DIR__ . '/../dao/CartDao.php';
require_once __DIR__ . "/baseservice.php";

class CartService extends BaseService {

    public function __construct() {
        parent::__construct(new CartDao());
    }

    public function addCart($data) {
        return $this->dao->addCart($data);
    }

    public function getCartById($id) {
        return $this->dao->getCartById($id);
    }

    public function getCartsByCustomer($customer_id) {
        return $this->dao->getCartsByCustomer($customer_id);
    }

    public function getCartsByOrder($order_id) {
        return $this->dao->getCartsByOrder($order_id);
    }

    public function getActiveCarts() {
        return $this->dao->getActiveCarts();
    }

    public function updateCart($id, $data) {

        if (isset($data['status']) && !in_array($data['status'], [0, 1])) {
            throw new Exception("Status must be 0 or 1.");
        }

        return $this->dao->updateCart($id, $data);
    }

    public function deleteCart($id) {
        return $this->dao->deleteCart($id);
    }

    public function getAllCarts() {
        return $this->dao->getAllCarts();
    }

    public function getCartsByTimeRange($from, $to) {
        return $this->dao->getCartsByTimeRange($from, $to);
    }
}
?>
