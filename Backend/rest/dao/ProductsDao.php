<?php
require_once __DIR__ . "/BaseDao.php";

class ProductDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("products"); 
    }

    public function getAllProducts()
    {
        return $this->query("SELECT * FROM products", []);
    }

    public function getProductById($id)
    {
        return $this->query_unique("SELECT * FROM products WHERE id = :id", ["id" => $id]);
    }

    public function addProduct($product)
    {
        return $this->add($product);
    }

    public function updateProduct($id, $product)
    {
        return $this->update($product, $id);
    }

    public function deleteProduct($id)
    {
        return $this->delete($id);
    }

    public function getProductsByCategory($category_id)
    {
        return $this->query(
            "SELECT * FROM products WHERE category_id = :category_id",
            ["category_id" => $category_id]
        );
    }

    public function getProductsByCustomer($customer_id)
    {
        return $this->query(
            "SELECT * FROM products WHERE customer_id = :customer_id",
            ["customer_id" => $customer_id]
        );
    }

    public function searchProducts($keyword)
    {
        return $this->query(
            "SELECT * FROM products WHERE name LIKE :keyword OR desctription LIKE :keyword",
            ["keyword" => "%" . $keyword . "%"]
        );
    }
}
?>
