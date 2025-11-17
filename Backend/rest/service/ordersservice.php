<?php
require_once __DIR__ . '/../dao/OrdersDao.php';
require_once __DIR__ . "/baseservice.php";

class OrdersService extends BaseService {

    public function __construct() {
        parent::__construct(new OrdersDao());
    }

    public function addOrder($data) {
        if (!is_numeric($data['total_amount']) || $data['total_amount'] <= 0) {
            throw new Exception("Total amount must be greater than zero.");
        }

        return $this->dao->addOrder($data);
    }

    public function getOrderById($id) {
        return $this->dao->getOrderById($id);
    }

    public function getAllOrders() {
        return $this->dao->getAllOrders();
    }

    public function getOrdersAboveAmount($amount) {
        return $this->dao->getOrdersAboveAmount($amount);
    }

    public function getOrdersByDate($date) {
        return $this->dao->getOrdersByDate($date);
    }

    public function getLatestOrders($limit = 10) {
        return $this->dao->getLatestOrders($limit);
    }

    public function updateOrder($id, $data) {
        if (isset($data['total_amount']) && (!is_numeric($data['total_amount']) || $data['total_amount'] <= 0)) {
            throw new Exception("Total amount must be greater than zero.");
        }
        return $this->dao->updateOrder($id, $data);
    }

    public function deleteOrder($id) {
        return $this->dao->deleteOrder($id);
    }
}
?>
