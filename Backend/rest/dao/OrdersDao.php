<?php
require_once __DIR__ . "/BaseDao.php";

class OrdersDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("orders");
    }

    public function getAllOrders()
    {
        return $this->query("SELECT * FROM orders", []);
    }

    public function getOrderById($id)
    {
        return $this->query_unique("SELECT * FROM orders WHERE id = :id", ["id" => $id]);
    }

    public function addOrder($order)
    {
        return $this->add($order);
    }

    public function updateOrder($id, $order)
    {
        return $this->update($order, $id);
    }

    public function deleteOrder($id)
    {
        return $this->delete($id);
    }

    public function getOrdersAboveAmount($amount)
    {
        return $this->query(
            "SELECT * FROM orders WHERE total_amount > :amount",
            ["amount" => $amount]
        );
    }

    public function getOrdersByDate($date)
    {
        return $this->query(
            "SELECT * FROM orders WHERE DATE(order_date) = :order_date",
            ["order_date" => $date]
        );
    }

    public function getLatestOrders($limit = 10)
    {
        return $this->query(
            "SELECT * FROM orders ORDER BY order_date DESC LIMIT :limit",
            ["limit" => $limit]
        );
    }
}
?>
