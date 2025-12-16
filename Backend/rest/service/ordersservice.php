<?php
require_once __DIR__ . '/../dao/OrdersDao.php';
require_once __DIR__ . '/../dao/OrderItemsDao.php';
require_once __DIR__ . "/baseservice.php";
require_once __DIR__ . "/productservice.php";

class OrdersService extends BaseService {

    private $orderItemsDao;
    private $productService;

    public function __construct() {
        parent::__construct(new OrdersDao());
        $this->orderItemsDao = new OrderItemsDao();
        $this->productService = new ProductService();
    }

    public function addOrder($data) {
        // Start a transaction
        $this->dao->beginTransaction();
        try {
            // Create the order first
            $order = parent::add(['user_id' => $data['user_id'], 'address' => $data['address']]);
            $total_amount = 0;

            // Add order items and calculate total amount
            foreach ($data['items'] as $item) {
                $product = $this->productService->getProductById($item['product_id']);
                if (!$product) {
                    throw new Exception("Product not found: " . $item['product_id']);
                }
                if ($product['stock_quantity'] < $item['quantity']) {
                    throw new Exception("Not enough stock for product: " . $product['name']);
                }

                $order_item = [
                    'order_id' => $order['id'],
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $product['price'] // Use product's current price
                ];
                $this->orderItemsDao->addOrderItem($order_item);

                // Update product stock
                $this->productService->updateProduct($product['id'], ['stock_quantity' => $product['stock_quantity'] - $item['quantity']]);

                $total_amount += $order_item['quantity'] * $order_item['price'];
            }

            // Update the order with the total amount
            parent::update($order, $order['id'], ['total_amount' => $total_amount]);

            $this->dao->commit();
            return $order;
        } catch (Exception $e) {
            $this->dao->rollBack();
            throw $e;
        }
    }

    public function getOrderById($id) {
        $order = $this->dao->getOrderById($id);
        if ($order) {
            $order['items'] = $this->orderItemsDao->getOrderItemsByOrderId($id);
        }
        return $order;
    }

    public function getAllOrders() {
        $orders = $this->dao->getAllOrders();
        foreach ($orders as &$order) {
            $order['items'] = $this->orderItemsDao->getOrderItemsByOrderId($order['id']);
        }
        return $orders;
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
        $this->dao->beginTransaction();
        try {
            // Update order details
            parent::update($data, $id);

            // Handle order items if provided
            if (isset($data['items'])) {
                // Delete existing items for simplicity, a more robust solution would compare and update
                $existing_items = $this->orderItemsDao->getOrderItemsByOrderId($id);
                foreach ($existing_items as $item) {
                    $this->orderItemsDao->deleteOrderItem($item['id']);
                }

                $total_amount = 0;
                foreach ($data['items'] as $item) {
                    $product = $this->productService->getProductById($item['product_id']);
                    if (!$product) {
                        throw new Exception("Product not found: " . $item['product_id']);
                    }
                    // Assuming stock is not re-calculated on update for simplicity, could be added if needed

                    $order_item = [
                        'order_id' => $id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'price' => $product['price']
                    ];
                    $this->orderItemsDao->addOrderItem($order_item);
                    $total_amount += $order_item['quantity'] * $order_item['price'];
                }
                parent::update(['total_amount' => $total_amount], $id);
            }

            $this->dao->commit();
            return $this->getOrderById($id);
        } catch (Exception $e) {
            $this->dao->rollBack();
            throw $e;
        }
    }

    public function deleteOrder($id) {
        // Delete order items first due to foreign key constraint with cascade on delete
        $this->dao->beginTransaction();
        try {
            $this->orderItemsDao->deleteOrderItemsByOrderId($id);
            parent::delete($id);
            $this->dao->commit();
        } catch (Exception $e) {
            $this->dao->rollBack();
            throw $e;
        }
    }
}
?>
