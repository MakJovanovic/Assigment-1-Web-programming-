<?php
require_once __DIR__ . "/BaseDao.php";

class CartDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("carts");
    }

    public function getAllCarts()
    {
        return $this->query("SELECT * FROM carts", []);
    }

    public function getCartById($id)
    {
        return $this->query_unique("SELECT * FROM carts WHERE id = :id", ["id" => $id]);
    }

    public function addCart($cart)
    {
        return $this->add($cart);
    }

    public function updateCart($id, $cart)
    {
        return $this->update($cart, $id);
    }

    public function deleteCart($id)
    {
        return $this->delete($id);
    }

    public function getCartsByCustomer($customer_id)
    {
        return $this->query(
            "SELECT * FROM carts WHERE customer_id = :customer_id",
            ["customer_id" => $customer_id]
        );
    }

    public function getCartsByOrder($order_id)
    {
        return $this->query(
            "SELECT * FROM carts WHERE order_id = :order_id",
            ["order_id" => $order_id]
        );
    }

    public function getActiveCarts()
    {
        return $this->query(
            "SELECT * FROM carts WHERE status = 1",
            []
        );
    }

    public function getCartsByTimeRange($from, $to)
    {
        return $this->query(
            "SELECT * FROM carts WHERE time BETWEEN :from AND :to",
            ["from" => $from, "to" => $to]
        );
    }
}
?>
