<?php
require_once __DIR__ . '/../dao/ProductsDao.php';
require_once __DIR__ . "/baseservice.php";

class ProductService extends BaseService {

    public function __construct() {
        parent::__construct(new ProductDao());
    }

    public function addProduct($data) {
     
        return $this->dao->addProduct($data);
    }

    public function getProductById($id) {
        return $this->dao->getProductById($id);
    }

    public function getAllProducts() {
        return $this->dao->getAllProducts();
    }

    public function getProductsByCategory($category_id) {
        return $this->dao->getProductsByCategory($category_id);
    }

    public function getProductsByCustomer($customer_id) {
        return $this->dao->getProductsByCustomer($customer_id);
    }

    public function searchProducts($keyword) {
        return $this->dao->searchProducts($keyword);
    }

    public function updateProduct($id, $data) {
        if (isset($data['stock_quantity']) && (!is_numeric($data['stock_quantity']) || $data['stock_quantity'] < 0)) {
            throw new Exception("Stock quantity cannot be negative.");
        }

        return $this->dao->updateProduct($id, $data);
    }

    public function deleteProduct($id) {
        return $this->dao->deleteProduct($id);
    }
}
?>
