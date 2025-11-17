<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/rest/config.php';
require_once __DIR__ . '/rest/service/userservice.php';
require_once __DIR__ . '/rest/service/customerservice.php';
require_once __DIR__ . '/rest/service/productservice.php';
require_once __DIR__ . '/rest/service/ordersservice.php';
require_once __DIR__ . '/rest/service/cartservice.php';

Flight::register('userService', 'UserService');
Flight::register('customerService', 'CustomerService');
Flight::register('productService', 'ProductService');
Flight::register('orderService', 'OrdersService');
Flight::register('cartService', 'CartService');

require_once __DIR__ . '/rest/Routes/user_routes.php';
require_once __DIR__ . '/rest/Routes/customer_routes.php';
require_once __DIR__ . '/rest/Routes/product_routes.php';
require_once __DIR__ . '/rest/Routes/order_routes.php';
require_once __DIR__ . '/rest/Routes/cart_routes.php';

Flight::start();
?>
