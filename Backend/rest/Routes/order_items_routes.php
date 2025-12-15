<?php
/**
 * @OA\Get(
 *     path="/order_items",
 *     summary="Get all order items",
 *     tags={"Order Items"},
 *     @OA\Response(
 *         response=200,
 *         description="List of all order items",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="order_id", type="integer", example=1),
 *                 @OA\Property(property="product_id", type="integer", example=1),
 *                 @OA\Property(property="quantity", type="integer", example=2),
 *                 @OA\Property(property="price", type="number", format="float", example=49.99)
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /order_items', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::orderItemsService()->get_all());
});

/**
 * @OA\Get(
 *     path="/order_items/{id}",
 *     summary="Get order item by ID",
 *     tags={"Order Items"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order Item ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item details",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="product_id", type="integer", example=1),
 *             @OA\Property(property="quantity", type="integer", example=2),
 *             @OA\Property(property="price", type="number", format="float", example=49.99)
 *         )
 *     ),
 *     @OA\Response(response=404, description="Order item not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /order_items/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::orderItemsService()->getOrderItemById($id));
});

/**
 * @OA\Get(
 *     path="/orders/{order_id}/items",
 *     summary="Get order items by Order ID",
 *     tags={"Order Items"},
 *     @OA\Parameter(
 *         name="order_id",
 *         in="path",
 *         required=true,
 *         description="Order ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of order items for the specified order",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="order_id", type="integer", example=1),
 *                 @OA\Property(property="product_id", type="integer", example=1),
 *                 @OA\Property(property="quantity", type="integer", example=2),
 *                 @OA\Property(property="price", type="number", format="float", example=49.99)
 *             )
 *         )
 *     ),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('GET /orders/@order_id/items', function($order_id) {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::orderItemsService()->getOrderItemsByOrderId($order_id));
});

/**
 * @OA\Post(
 *     path="/order_items",
 *     summary="Create a new order item",
 *     tags={"Order Items"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             required={"order_id", "product_id", "quantity", "price"},
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="product_id", type="integer", example=1),
 *             @OA\Property(property="quantity", type="integer", example=2),
 *             @OA\Property(property="price", type="number", format="float", example=49.99)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item created successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="product_id", type="integer", example=1),
 *             @OA\Property(property="quantity", type="integer", example=2),
 *             @OA\Property(property="price", type="number", format="float", example=49.99)
 *         )
 *     ),
 *     @OA\Response(response=400, description="Invalid input"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('POST /order_items', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderItemsService()->addOrderItem($data));
});

/**
 * @OA\Patch(
 *     path="/order_items/{id}",
 *     summary="Update an order item",
 *     tags={"Order Items"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order Item ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="product_id", type="integer", example=1),
 *             @OA\Property(property="quantity", type="integer", example=2),
 *             @OA\Property(property="price", type="number", format="float", example=49.99)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item updated successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="product_id", type="integer", example=1),
 *             @OA\Property(property="quantity", type="integer", example=2),
 *             @OA\Property(property="price", type="number", format="float", example=49.99)
 *         )
 *     ),
 *     @OA\Response(response=404, description="Order item not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('PATCH /order_items/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderItemsService()->updateOrderItem($id, $data));
});

/**
 * @OA\Delete(
 *     path="/order_items/{id}",
 *     summary="Delete an order item",
 *     tags={"Order Items"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order Item ID",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(response=200, description="Order item deleted successfully"),
 *     @OA\Response(response=404, description="Order item not found"),
 *     @OA\Response(response=500, description="Server error")
 * )
 */
Flight::route('DELETE /order_items/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::orderItemsService()->deleteOrderItem($id);
});

?>
