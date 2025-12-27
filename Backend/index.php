<?php
//For handeling OPTIONS request on local host

header("Access-Controle-Allow-Origin: *");
header("Access-Controle-Allow-Headers: Content-Type, Authorization");
header("Access-Controle-Allow-Methods: POST, DELETE, OPTIONS");

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    return 0;
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/rest/config.php';
require_once __DIR__ . '/rest/service/userservice.php';
require_once __DIR__ . '/rest/service/productservice.php';
require_once __DIR__ . '/rest/service/ordersservice.php';
require_once __DIR__ . '/rest/service/cartservice.php';
require_once __DIR__ . '/rest/service/orderitemsservice.php';
require 'rest/service/AuthService.php';
require 'middleware/AuthMiddleware.php';
require_once __DIR__ . "/data/roles.php";


use Firebase\JWT\JWT;
use Firebase\JWT\Key;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


Flight::register('userService', 'UserService');
Flight::register('productService', 'ProductService');
Flight::register('orderService', 'OrdersService');
Flight::register('cartService', 'CartService');
Flight::register('orderItemsService', 'OrderItemsService');
Flight::register('auth_service', "AuthService");
Flight::register('auth_middleware', "AuthMiddleware");

Flight::before('start', function() {
   if(
       strpos(Flight::request()->url, '/auth/login') === 0 ||
       strpos(Flight::request()->url, '/auth/register') === 0
   ) {
       return TRUE;
   } else {
       try {
           $token = Flight::request()->getHeader("Authentication");
           if(Flight::auth_middleware()->verifyToken($token))
               return TRUE;
       } catch (\Exception $e) {
           Flight::halt(401, $e->getMessage());
       }
   }
});


require_once __DIR__ . '/rest/Routes/user_routes.php';
require_once __DIR__ . '/rest/Routes/product_routes.php';
require_once __DIR__ . '/rest/Routes/order_routes.php';
require_once __DIR__ . '/rest/Routes/cart_routes.php';
require_once __DIR__ . '/rest/Routes/order_items_routes.php';
require_once __DIR__ . '/rest/Routes/AuthRoutes.php';

Flight::start();
?>
