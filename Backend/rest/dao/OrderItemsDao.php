<?php
require_once __DIR__ . "/BaseDao.php";

class OrderItemsDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("order_items");
    }

    public function getOrderItemById($id)
    {
        return $this->query_unique("SELECT * FROM order_items WHERE id = :id", ["id" => $id]);
    }

    public function getOrderItemsByOrderId($order_id)
    {
        return $this->query("SELECT * FROM order_items WHERE order_id = :order_id", ["order_id" => $order_id]);
    }

    public function addOrderItem($order_item)
    {
        return $this->add($order_item);
    }

    public function updateOrderItem($id, $order_item)
    {
        return $this->update($order_item, $id);
    }

    public function deleteOrderItem($id)
    {
        $this->delete($id);
    }
}
?>
