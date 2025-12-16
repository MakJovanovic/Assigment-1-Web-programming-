<?php
require_once __DIR__ . '/../dao/OrderItemsDao.php';
require_once __DIR__ . "/baseservice.php";

class OrderItemsService extends BaseService
{

    public function __construct()
    {
        parent::__construct(new OrderItemsDao());
    }

    public function getOrderItemById($id)
    {
        return $this->dao->getOrderItemById($id);
    }

    public function getOrderItemsByOrderId($order_id)
    {
        return $this->dao->getOrderItemsByOrderId($order_id);
    }

    public function addOrderItem($data)
    {
        return $this->dao->addOrderItem($data);
    }

    public function updateOrderItem($id, $data)
    {
        return $this->dao->updateOrderItem($id, $data);
    }

    public function deleteOrderItem($id)
    {
        return $this->dao->deleteOrderItem($id);
    }
}
?>
